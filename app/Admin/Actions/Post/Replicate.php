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
        // 1天2周3月4季度5半年6全年
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
        }

        return date("Y-m-d H:i:s", (string)$value);
    }

    public function handle(Model $model, Request $request): Response
    {
        $type = $request->post("type");
        $time = $request->post("times");
        $startTime = $request->post("start_time", date("Y-m-d H:i:s"));
        $money = $request->post("money");
        $weChatId = $request->post("wechat_id");
        $remark = $request->post("remark", "");
        DB::beginTransaction();
        try {
            $updateRows = UserGptKeys::query()->where("wechat_id", "=", $weChatId)->update([
                "start_at" => $startTime,
                "end_at"   => $this->calculateEndAt($type, $time, $startTime),
            ]);

            $historyModel = UpVipHistory::query()->create([
                "wechat_id"     => $weChatId,
                "times"         => $time,
                "money"         => $money,
                "remark"        => $remark,
                "vip_config_id" => $type,
                "start_time"    => $startTime,
                'end_time'      => $this->calculateEndAt($type, $time, $startTime),
            ]);
            if ($updateRows && $historyModel->getKey()) {
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
        $this->select('type', '充值类型')->options(UpVipConfig::getConfig());
        $this->text('times', '充值时长')->default(0.00)->rules('required|min:0.01|decimal:0,2')->help("值只能是浮点数，保留1~2位小数");
        $this->datetime("start_time", "开始时间")->help("该时间表示会员正式生效的时间，不勾选则默认会当前时间。");
        $this->text("money", "充值金额")->default(0.01)->rules('required|min:0.01|decimal:0,2')->help("值只能是浮点数，保留1~2位小数");
        $this->hidden("wechat_id", "会员编号")->default($this->getRow()->getAttribute("id"));
        $this->textarea('remark', '订单备注')->help("填写额外的订单信息，有助于历史数据查询");
    }

}
