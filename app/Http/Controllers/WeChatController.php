<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Overtrue\LaravelWeChat\EasyWeChat;

class WeChatController extends Controller
{
    public function serve(Request $request)
    {
        $easyWeChat = EasyWeChat::officialAccount();
        $server = $easyWeChat->getServer();
        $server->addEventListener('subscribe', function ($message) {

            return "感谢关注我的编程网,请发送你的验证码!";
        });

        $server->addEventListener('unsubscribe', function ($message) {
            $msg = json_decode($message, true);
            $openid = $msg['FromUserName'];
            if (Cache::has($openid)){
                $ip = Cache::get($openid);
                Cache::set($ip,false);
                Cache::delete($openid);
            }
        });

        $server->addMessageListener('text', function ($message) {
            $msg = json_decode($message, true);
            //获取微信用户信息

            $key = $msg['Content'];
            $openid = $msg['FromUserName'];
            if (Cache::has($key)) {
                $val = Cache::get($key);
                //验证过删除
                Cache::delete($key);
                //更新是验证过的
                Cache::set($val, true);
                //存储openId
                Cache::put($openid,$val);
                return '解锁成功！';
            }
            return "验证码错误";
        });


        return $server->serve();

    }

}
