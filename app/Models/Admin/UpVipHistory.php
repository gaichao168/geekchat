<?php
declare(strict_types = 1);

namespace App\Models\Admin;

class UpVipHistory extends AdminBaseModel
{
    protected $table = "up_vip_history";

    protected $fillable = [
        "wechat_id",
        "times",
        "money",
        "remark",
        "vip_config_id",
        "start_time",
        "end_time",
    ];

    public function getVipConfigIdAttribute($key): string
    {
        //1天2周3月4季度5半年6全年
        $configArray = [
            1 => "天",
            2 => "周",
            3 => "月",
            4 => "季度",
            5 => "半年",
            6 => "全年",
            7 => "终身",
            8 => "次数",
        ];
        return $configArray[$key];
    }
}
