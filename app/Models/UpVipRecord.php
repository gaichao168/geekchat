<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpVipRecord extends Model
{
    use HasFactory;

    protected $table = 'up_vip_records';

    protected $fillable=[
        'wechat_id','month'
    ];

    public function wechatUser()
    {
        return $this->belongsTo(WechatUser::class,'wechat_id');
    }
}
