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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('message', App\Http\Controllers\MessageController::class);

Route::apiResource('friend', App\Http\Controllers\FriendController::class);

Route::apiResource('interest', App\Http\Controllers\InterestController::class);

Route::apiResource('place', App\Http\Controllers\PlaceController::class);

Route::apiResource('user', App\Http\Controllers\UserController::class);