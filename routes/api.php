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

Route::post('auth/login',[\App\Http\Controllers\API\Auth\AuthController::class,'login']);

Route::get('users',[\App\Http\Controllers\Api\Users\UserController::class,'index'])->name('users.index');
Route::get('users/{id}',[\App\Http\Controllers\API\Users\UserController::class,'show'])->name('users.show');

Route::get('products',[\App\Http\Controllers\API\Products\ProductController::class,'index']);

Route::get('products/{id}',[\App\Http\Controllers\API\Products\ProductController::class,'show'])->name('products.show');

