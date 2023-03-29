<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShareController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ChatController::class . '@index')->name('home');
Route::get('/messages', ChatController::class . '@messages')->name('messages');
Route::post('/chat', ChatController::class . '@chat')->name('chat')->middleware('throttle:chat');
Route::post('/translate', ChatController::class . '@translate')->name('translate')->middleware('throttle:chat');
Route::get('/stream', ChatController::class . '@stream')->name('stream');
Route::post('/valid', ChatController::class . '@valid')->name('valid');
Route::post('/amount', ChatController::class . '@amount')->name('amount');
Route::post('/audio', ChatController::class . '@audio')->name('audio')->middleware('throttle:audio');
Route::post('/image', ChatController::class . '@image')->name('image')->middleware('throttle:imgae');
Route::get('/reset', ChatController::class . '@reset')->name('reset');

Route::group(['prefix'=>'shares'],function (){
   Route::get('/',[ShareController::class,'index'])->name('shares');
   Route::get('/{share}',[ShareController::class,'show'])->name('shares.show');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
