<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGptKey;
use App\Models\WechatUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userTotal = WechatUser::count();

        //vip用户
        $vipTotal = UserGptKey::where('start_at','<',now())
            ->where('end_at','>',now())
            ->count();

        return response()->json(['code'=>'0000','data'=>[
            'user_total'=>$userTotal,
            'vip_total'=>$vipTotal,
        ]]);
    }
}
