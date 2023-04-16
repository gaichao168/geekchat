<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\SystemController;
use App\Http\Controllers\Api\Admin\UserController;

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Api\Admin'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/dict/list', [SystemController::class, 'dict']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::resource('/users', UserController::class)->only('index');
        Route::post('/users/upVip', [UserController::class, 'upVip']);
    });
});
