<?php

namespace App\Http\Controllers;

use App\Models\UserGptKey;
use Illuminate\Http\Request;

class ValidKeyController extends Controller
{
    public function validKey(Request $request)
    {
        $key = $request->get('key');
        $validRes = UserGptKey::where('key', $key)
            ->where('start_at', '<=', now())
            ->where('end_at', '>', now())
            ->exists();
        return response()->json(['status' => 'success', 'msg' => '验证成功', 'data' => ['validRes' => $validRes]]);
    }
}
