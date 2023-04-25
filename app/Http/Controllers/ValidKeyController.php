<?php

namespace App\Http\Controllers;

use App\Models\UserGptKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ValidKeyController extends Controller
{
    public function validKey(Request $request)
    {
        $key = $request->get('key');
        $validRes = UserGptKey::where(function (Builder $query) use ($key) {
            $query->where('key', $key)
                ->where('start_at', '<=', now())
                ->where('end_at', '>', now());
        })
            ->orWhere(function (Builder $query) use ($key) {
                $query->where('key', $key)
                    ->where('numbers', '>', 0);
            })
            ->exists();
        return response()->json(['status' => 'success', 'msg' => '验证成功', 'data' => ['validRes' => $validRes]]);
    }
}
