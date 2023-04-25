<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserGptKey;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $cacheKey = sprintf("user:gpt:key:%s", $key);
        $userKey = Cache::remember($cacheKey, 18000, function () use ($key) {
            return UserGptKey::select(['key', 'id', 'start_at', 'end_at', 'numbers'])
                ->where('key', $key)
                ->first();
        });
        if (empty($userKey)) {
            Cache::delete($cacheKey);
            return response()->json(['msg' => 'success', 'verify_res' => false]);
        }

        if ($userKey->numbers > 0) {// 存在次数并且可用次数大于0，优先扣减次数
            try {
                $userKey->decrement("numbers");
            } catch (Throwable $throwable) {
                return response()->json(['msg' => 'success', 'verify_res' => false]);
            }
            return response()->json(['msg' => 'success', 'verify_res' => true]);
        }
        //判断时间
        if ($currentAt->gt($userKey->start_at) && Carbon::parse($userKey->end_at)->gt($currentAt)) {
            return response()->json(['msg' => 'success', 'verify_res' => true]);
        }
        Cache::delete($cacheKey);
        return response()->json(['msg' => 'success', 'verify_res' => false]);

    }
}
