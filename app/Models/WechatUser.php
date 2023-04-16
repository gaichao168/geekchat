<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatUser extends Model
{
    use HasFactory;

    protected $table = 'wechat_users';
    protected $fillable = ['openid','subscribe'];

    public function userGptKey()
    {
        return $this->hasOne(UserGptKey::class,'wechat_id','id');
    }

    public function upVipRecords()
    {
        return $this->hasMany(UpVipRecord::class,'wechat_id','id');
    }
}
