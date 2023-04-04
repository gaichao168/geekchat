<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Overtrue\LaravelWeChat\EasyWeChat;

class WeChatController extends Controller
{
    public function serve(Request $request)
    {
        $server = EasyWeChat::officialAccount()->getServer();

        $server->addEventListener('subscribe',function ($message){

           return "感谢关注我的编程网,请发送你的验证码!";
        });

        $server->addEventListener('unsubscribe',function ($message){

        });

        $server->addMessageListener('text',function ($message){
           $msg = json_decode($message,true);
           $key = $msg['Content'];
           if(Cache::has($key)){
               $val = Cache::get($key);
               Cache::put($val,true);
               return  '解锁成功！';
           }
            return "验证码错误";
        });

        return $server->serve();

    }

}
