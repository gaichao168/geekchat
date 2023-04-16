<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function dict()
    {
        return response()->json([
            'code'=>'0000',
            'data'=>[
                'importance'=>[
                    1=>[
                        'value'=>0,
                        'label'=>'tableDemo.commonly'
                    ],
                    2=>[
                        'value'=>1,
                        'label'=>'tableDemo.good'
                    ],
                    3=>[
                        'value'=>2,
                        'label'=>'tableDemo.important'
                    ]
                ]
            ]
        ]);
    }
}
