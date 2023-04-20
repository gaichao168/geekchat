<?php

namespace App\Admin\Actions\Post;

use App\Models\Admin\UpVipConfig;
use App\Models\Admin\UpVipHistory;
use App\Models\Admin\UserGptKeys;
use Encore\Admin\Actions\Response;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class Replicate extends RowAction
{
    public $name = '会员充值';

    private function calculateEndAt($type, $time, $start): string
    {
        // 1天2周3月4季度5半年6全年7终身8次数
        $value = "";
        $start = strtotime($start);
        switch ($type) {
            case 1:
                $value = $start + $time * 86400;
                break;
            case 2:
                $value = $start + ($time * 86400) * 7;
                break;
            case 3:
                $value = $start + ($time * 86400) * 30;
                break;
            case 4:
                $value = $start + ($time * 86400) * 30 * 3;
                break;
            case 5:
                $value = $start + ($time * 86400) * 30 * 6;
                break;
            case 6:
                $value = $start + ($time * 86400) * 30 * 12;
                break;
            case 7:
                $value = $start + ($time * 86400) * 30 * 100;
                break;
            case 8:
                $value = $start + 1;
                break;
        }

        return date("Y-m-d H:i:s", (int)$value);
    }

    public function handle(Model $model, Request $request): Response
    {
        // 获取当前用户的会员过期时间

        $type         = $request->post("type");
        $time         = $request->post("times");
        $startTime    = $request->post("start_time", date("Y-m-d H:i:s"));
        $money        = $request->post("money");
        $weChatId     = $request->post("wechat_id");
        $remark       = $request->post("remark", "");
        $gptKeyConfig = UserGptKeys::query()->where("wechat_id", "=", $weChatId)->first(["end_at", "start_at"]);
        // vip原本的开始时间
        $vipStartTime = $startTime;
        if (!empty($gptKeyConfig)) {
            $gptKeyConfig = $gptKeyConfig->toArray();
            if (strtotime($gptKeyConfig["end_at"]) > time()) { // 会员未过期
                $startTime    = date("Y-m-d", strtotime($gptKeyConfig["end_at"])) . " " . date("H:i:s");
                $vipStartTime = $gptKeyConfig["start_at"];
            }
        }
        DB::beginTransaction();
        try {
            if ($type != 8) {
                $updateRows = UserGptKeys::query()->where("wechat_id", "=", $weChatId)->update([
                    "start_at" => $vipStartTime,
                    "end_at" => $this->calculateEndAt($type, $time, $startTime),
                ]);
            }
            if ($type == 8) {
                UserGptKeys::query()->where("wechat_id", "=", $weChatId)->increment("numbers", (int)$time);
            }
            $historyModel = UpVipHistory::query()->create([
                "wechat_id" => $weChatId,
                "times" => $time,
                "money" => $money,
                "remark" => $remark,
                "vip_config_id" => $type,
                "start_time" => $startTime,
                'end_time' => $this->calculateEndAt($type, $time, $startTime),
            ]);
            if ($historyModel->getKey()) {
                DB::commit();
                return $this->response()->success('充值成功')->refresh();
            }
            DB::rollBack();
            return $this->response()->error('充值失败');
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $this->response()->error($throwable->getMessage());
        }
    }

    public function form(): void
    {
        $this->select('type', '充值类型')->options(UpVipConfig::getConfig())->help("选择按次数充值类型时，下列的充值时长表示可使用次数");
        $this->text('times', '充值时长(次数)')->default(0.00)->rules('required|min:0.01|decimal:0,2')->help("值只能是浮点数，保留1~2位小数");
        //$this->datetime("start_time", "开始时间")->help("该时间表示会员正式生效的时间，不勾选则默认会当前时间。");
        $this->text("money", "充值金额")->default(0.01)->rules('required|min:0.01|decimal:0,2')->help("值只能是浮点数，保留1~2位小数");
        $this->hidden("wechat_id", "会员编号")->default($this->getRow()->getAttribute("id"));
        $this->textarea('remark', '订单备注')->help("填写额外的订单信息，有助于历史数据查询");
    }

}
