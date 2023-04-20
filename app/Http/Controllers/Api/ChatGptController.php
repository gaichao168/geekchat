<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserGptKey;
use Illuminate\Http\Request;
use Throwable;

class ChatGptController extends Controller
{
    public function verify(Request $request)
    {
        $this->validate($request, [
            'key' => 'required'
        ]);

        $key = $request->get('key');

        $currentAt = now();
//        $userKey = UserGptKey::where('key',$key)
//            ->where('start_at','<',$currentAt)
//            ->where('end_at','>=',$currentAt)
//            ->first();
        $userKey = UserGptKey::query()->where("key", "=", $key)->first(["numbers", "start_at", "end_at", "id"]);
        if (empty($userKey)) {
            return response()->json(['msg' => 'success', 'verify_res' => false]);
        }
        $userKey = $userKey->toArray();
        if ($userKey["numbers"] > 0) {// 存在次数并且可用次数大于0，优先扣减次数
            try {
                UserGptKey::query()->where("id", "=", $userKey["id"])->decrement("number");
            } catch (Throwable $throwable) {
                return response()->json(['msg' => 'success', 'verify_res' => false]);
            }
            return response()->json(['msg' => 'success', 'verify_res' => true]);
        }
        if ((strtotime($userKey["end_at"]) >= strtotime(date("Y-m-d H:i:s")))) {// 不存在次数并且还在会员有效期内，则按照会员有效期进行处理
            return response()->json(['msg' => 'success', 'verify_res' => true]);
        }
        return response()->json(['msg' => 'success', 'verify_res' => false]);
    }
}
