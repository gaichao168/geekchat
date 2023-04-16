<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpVipRequest;
use App\Http\Resources\Admin\UserCollection;
use App\Http\Resources\Admin\UserResource;
use App\Models\UpVipRecord;
use App\Models\UserGptKey;
use App\Models\WechatUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = WechatUser::with('userGptKey:wechat_id,key,start_at,end_at')->paginate(15);

        $list = new UserCollection($users);
        return response()->json(['code' => '0000', 'data' => $list]);
    }

    public function upVip(UpVipRequest $request)
    {
        $userId = $request->user_id;
        $month = $request->month;

        //获取key
        $gptKey = UserGptKey::where('wechat_id', $userId)->first();

        //说明用户还没有生成key，需要新生成一个
        if (empty($gptKey)) {
            UserGptKey::create([
                'wechat_id' => $userId,
                'key' => 'wo-' . md5(sprintf('%s%d', random_bytes(32), time())),
                'start_at' => now(),
                'end_at' => now()->addMonths($month)
            ]);
        } else {
            $endAt = Carbon::parse($gptKey->end_at);
            if (now()->gt($endAt)) {
                $endAt = now();
            }
            $gptKey->update(['end_at' => $endAt->addMonths($month)]);
        }
        UpVipRecord::create([
            'wechat_id'=>$userId,
            'month'=>$month
        ]);
        $user = WechatUser::with('userGptKey')->find($userId);

        return response()->json(['code' => '0000', 'data' => new UserResource($user)]);
    }
}
