<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $admin = Admin::where('account',$request->account)->first();
        if (empty($admin)){
            return response()->json(['code'=>'500','message'=>'用户名或者密码错误']);
        }

        if (Hash::check($request->password,$admin->password)){
           $auth =  $admin->createToken('admin');
           return response()->json(['code'=>'0000','data'=>['token'=>$auth->plainTextToken,'username'=>$admin->account,'role'=>'admin','roleId'=>'1','permissions'=>['*.*.*']]]);
        }
        return response()->json(['code'=>'500','message'=>'用户名或者密码错误']);
    }
}
