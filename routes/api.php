<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function (){
   Route::post('login', LoginController::class);
   Route::post('register', RegisterController::class);
   Route::post('logout', LogoutController::class)->middleware('auth:api');
});

Route::prefix('product')->middleware('auth:api')->group(function () {
    Route::post('buy/{product}', [ProductController::class, 'buy']);
    Route::post('rent/{product}', [ProductController::class, 'rent']);
    Route::post('rent/extend/{product}', [ProductController::class, 'extendRentPeriod']);
});

