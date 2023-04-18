<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index()
    {
        $shares = Share::query()->where('hide',0)->latest()->get();

        return view('shares.index',compact('shares'));
    }

    public function show(Share $share)
    {
        return view('shares.show',compact('share'));
    }
}
