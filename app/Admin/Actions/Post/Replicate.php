<?php

namespace App\Admin\Actions\Post;

use App\Models\Admin\UpVipConfig;
use App\Models\Admin\UpVipHistory;
use App\Models\Admin\UserGptKeys;
use Carbon\Carbon;
use Encore\Admin\Actions\Response;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class Replicate extends RowAction
{
    public $name = '会员充值';

    private function calculateEndAt(int $type, int $times, Carbon $start): Carbon
    {
        // 1天2周3月4季度5半年6全年7终身8次数
        $value = clone $start;

        switch ($type) {
            case 1:
                $value = $value->addDays($times);
                break;
            case 2:
                $value = $value->addDays(7 * $times);
                break;
            case 3:
                $value = $value->addMonths($times);
                break;
            case 4:
                $value = $value->addMonths(3 * $times);
                break;
            case 5:
                $value = $value->addMonths(6 * $times);
                break;
            case 6:
                $value = $value->addYears($times);
                break;
            case 7:
                $value = $value->addYears(100);
                break;
        }
        return $value;
    }

    public function handle(Model $model, Request $request): Response
    {
        // 获取当前用户的会员过期时间

        $type = $request->post("type");
        $times = $request->post("times");
//        $startTime    = $request->post("start_time", date("Y-m-d H:i:s"));
        $money = $request->post("money");
        $weChatId = $request->post("wechat_id");
        $remark = $request->post("remark", "");
        $gptKey = UserGptKeys::query()->where("wechat_id", "=", $weChatId)->first(["id", "end_at", "start_at"]);
        if (empty($gptKey)) {
            return $this->response()->error('充值失败');
        }
        // vip原本的开始时间
        $vipStartTime = Carbon::parse($gptKey->start_at);
        if (Carbon::parse($gptKey->end_at)->gt(now()) && $times > 0) { // 会员未过期
            $vipStartTime = Carbon::parse($gptKey->end_at);
        }
        DB::beginTransaction();
        try {
            if ($type == 8) {
                $gptKey->increment("numbers", (int)$times);
            } else {

                $gptKey->update([
                    "start_at" => $vipStartTime,
                    "end_at" => $this->calculateEndAt($type, $times, $vipStartTime),
                ]);

            }
            $historyModel = UpVipHistory::query()->create([
                "wechat_id" => $weChatId,
                "times" => $times,
                "money" => $money,
                "remark" => $remark,
                "vip_config_id" => $type,
                "start_time" => $vipStartTime,
                'end_time' => $gptKey->end_at,
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
        $this->select('type', '充值类型')->options(UpVipConfig::getConfig())->default(1)->rules('required')->help("选择按次数充值类型时，下列的充值时长表示可使用次数");
        $this->text('times', '数量')->default(1)->rules('required|integer|min:-10000')->help("值只能是整数（可以是负数）最小-10000");
        //$this->datetime("start_time", "开始时间")->help("该时间表示会员正式生效的时间，不勾选则默认会当前时间。");
        $this->text("money", "充值金额")->default(0.01)->rules('required|min:0.01|decimal:0,2')->help("值只能是浮点数，保留1~2位小数");
        $this->hidden("wechat_id", "会员编号")->default($this->getRow()->getAttribute("id"));
        $this->textarea('remark', '订单备注')->help("填写额外的订单信息，有助于历史数据查询");
    }

}
