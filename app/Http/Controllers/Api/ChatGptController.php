<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserGptKey;
use Illuminate\Http\Request;

class ChatGptController extends Controller
{
    public function verify(Request $request)
    {
        $this->validate($request,[
            'key'=>'required'
        ]);

        $key = $request->get('key');

        $currentAt = now();
        $userKey = UserGptKey::where('key',$key)
            ->where('start_at','<',$currentAt)
            ->where('end_at','>=',$currentAt)
            ->first();
        if (empty($userKey)){
            return response()->json(['msg'=>'success','verify_res'=>false]);
        }

        return  response()->json(['msg'=>'success','verify_res'=>true]);
    }
}
