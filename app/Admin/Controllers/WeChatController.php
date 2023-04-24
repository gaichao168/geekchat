<?php
declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Replicate;
use App\Models\Admin\WeChat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;

class WeChatController extends AdminController
{
    protected $title = "微信用户";

    public function grid(): Grid
    {
        $grid = new Grid(new WeChat());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 3, function ($filter) {
                $filter->equal("subscribe", "关注公众号")->select(["未关注", "已关注"]);
            });
            $filter->column(1 / 3, function ($filter) {
                $filter->equal('key.key', '身份口令');
            });
            $filter->column(1 / 3, function ($filter) {
                $filter->between('created_at', "注册时间")->datetime();
            });
        });

        $grid->model()->orderByDesc("id");
        $grid->column("id", "数据编号")->sortable()->modal("充值记录", function ($model) {
            $comments = $model->history()->take(20)->orderByDesc("id")->get()->map(function ($comment) {
                return $comment->only(['id', "vip_config_id", "times", "start_time", "end_time", 'money', 'created_at', "remark"]);
            });
            return new Table(['数据编号', "充值类型", "充值时长(次数)", "生效开始时间", "到期结束时间", '充值金额', '充值时间', "充值备注"], $comments->toArray());
        });
        $grid->column("openid", "openid");
        $grid->column("key.key", "身份口令");
        $grid->column("key.start_at", "生效时间");
        $grid->column("key.end_at", "结束时间");
        $grid->column("key.numbers", "剩余次数");
        $grid->column("created_at", "创建时间");
        $grid->column('subscribe', "公众号状态")->display(function ($subscribe) {
            if ($subscribe == 1) {
                return "<span style='color:#059B50'>已关注</span>";
            }
            return "<span style='color:#E70F0FFF'>未关注</span>";
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->add(new Replicate());
        });
        $grid->disableCreateButton();

        return $grid;
    }
}
