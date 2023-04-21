<?php

namespace App\Http\Controllers;

use App\Models\UserGptKey;
use App\Models\WechatUser;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Overtrue\LaravelWeChat\EasyWeChat;
use Str;

class WeChatController extends Controller
{
    public function serve(Request $request)
    {
        $easyWeChat = EasyWeChat::officialAccount();
        $server = $easyWeChat->getServer();
        $server->addEventListener('subscribe', function ($message) {
            $msg = json_decode($message, true);
            $openid = $msg['FromUserName'];

            $user = WechatUser::firstOrCreate(['openid' => $openid]);
            $user->subscribe = 1;
            $user->save();
            //为用户创建身份口令，并有一天体验时间
            $number = sprintf('u-10000%d', $user->id);
            $startAt = now();
            $endAt = now()->addDay();
            $key = 'wo-' . md5(Str::random(42) . time());
            $gptKey = UserGptKey::firstOrCreate(['wechat_id' => $user->id], [
                'key' => $key,
                'start_at' => $startAt,
                'end_at' => $endAt,
            ]);
            $hours = Carbon::parse($gptKey->end_at)->diffInHours(now());
            $surplusAt = 0;
            if ($hours > 0) {
                $surplusAt = round($hours / 24, 1);
            }
            return "感谢关注!\n用户编号: $number\n身份口令：$gptKey->key\n会员剩余天数：$surplusAt 天\n1.验证请发送提示的：验证码\n2.查询信息请发送：信息\n3.加群请发送：加群\n4.续费请发送：续费\n5.免费系统：https://chat.wobcw.com\n6.会员系统：https://gpt.wobcw.com\n友情提示：😀新用户赠送！赠送！赠送你 $surplusAt 天会员系统体验时间,进入会员系统后要设置你的身份口令哦，快进入会员系统体验吧🤩！具体使用教程请查看公众号历史文章哦~";
        });

        $server->addEventListener('unsubscribe', function ($message) {
            $msg = json_decode($message, true);
            $openid = $msg['FromUserName'];

            $user = WechatUser::firstOrCreate(['openid' => $openid]);
            $user->subscribe = 0;
            $user->save();

            if (Cache::has($openid)) {
                $ip = Cache::get($openid);
                Cache::set($ip, false);
                Cache::delete($openid);
            }
        });

        $server->addMessageListener('text', function ($message) {
            $msg = json_decode($message, true);
            //获取微信用户信息
            $openid = $msg['FromUserName'];
            $str = $msg['Content'];
            if (strpos($str, "聊天") !== false || strpos($str, "信息") !== false) {
                $user = WechatUser::firstOrCreate(['openid' => $openid]);
                $startAt = now();
                $endAt = now()->addDays(1);
                $gptKey = UserGptKey::firstOrCreate(['wechat_id' => $user->id], [
                    'key' => 'wo-' . md5(Str::random(42) . time()),
                    'start_at' => $startAt,
                    'end_at' => $endAt,
                ]);
                $number = sprintf('u-10000%d', $user->id);
                $hours = Carbon::parse($gptKey->end_at)->diffInHours(now());
                $surplusAt = 0;
                if ($hours > 0) {
                    $surplusAt = round($hours / 24, 1);
                }
                return sprintf("你好！\n你的会员编号:%s\n你的身份口令是：%s\n剩余天数：%.1f 天\n会员系统地址：https://gpt.wobcw.com", $number, $gptKey->key, $surplusAt);
            } else if (strpos($str, "群") !== false) {

                return [
                    'MsgType' => 'image',
                    'Image' => [
                        'MediaId' => config('easywechat.wechat_group_media_id'),
                    ],
                ];

            } elseif (strpos($str, "续费") !== false) {
                return [
                    'MsgType' => 'image',
                    'Image' => [
                        'MediaId' => config('easywechat.wechat_media_id'),
                    ],
                ];
            } else {
                $openid = $msg['FromUserName'];
                if (Cache::has($str)) {
                    $val = Cache::get($str);
                    //验证过删除
                    Cache::delete($str);
                    //更新是验证过的
                    Cache::set($val, true);
                    //存储openId
                    Cache::put($openid, $val);
                    return '解锁成功！';
                }
                return "验证码错误";
            }

        });


        return $server->serve();

    }

}
