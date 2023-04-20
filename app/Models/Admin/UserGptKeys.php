<?php
declare(strict_types = 1);

namespace App\Models\Admin;

class UserGptKeys extends AdminBaseModel
{
    protected $table = "user_gpt_keys";

    protected $fillable = [
        'key',
        'start_at',
        'end_at',
        'wechat_id',
        "numbers",
    ];
}
