<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'prefix' => '',
    'as' => 'api',
    'namespace' => 'api',
    'middleware' => ['auth:api']
], function () {
    Route::post('/room/store', [\App\Http\Controllers\RoomController::class, 'store']);
    Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'messages'])->name('messages');
    Route::post('/message/store', [\App\Http\Controllers\MessageController::class, 'store'])->name('message');
});

Route::group([
    'prefix' => '',
    'as' => 'api',
    'namespace' => 'api',
    'middleware' => ['api']
], function () {
    Route::get('/rooms', [\App\Http\Controllers\RoomController::class, 'rooms']);
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'users']);
    Route::post('/user/signup', [\App\Http\Controllers\UserController::class, 'signup']);
    Route::post('/user/signin', ['uses'=>'\App\Http\Controllers\UserController@signin','as'=>'login']);
});
