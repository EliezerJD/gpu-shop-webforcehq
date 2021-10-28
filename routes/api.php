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

Route::post('login',[\App\Http\Controllers\API\Auth\AuthController::class,'login']);
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout',[\App\Http\Controllers\API\Auth\AuthController::class,'logout']);
    Route::get('users/profile',[\App\Http\Controllers\API\Users\UserController::class,'profile']);
});

Route::group(['middleware'=>['auth:api','userIsAdmin']],function(){
	Route::get('users',[\App\Http\Controllers\Api\Users\UserController::class,'index'])->name('users.index');
	Route::get('users/{id}',[\App\Http\Controllers\API\Users\UserController::class,'show'])->name('users.show');
	Route::put('users/{user}',[\App\Http\Controllers\API\Users\UserController::class,'update'])->name('users.update');
	 Route::delete('users/{user}',[\App\Http\Controllers\API\Users\UserController::class,'destroy'])->name('users.destroy');
});

Route::group(['middleware'=>['auth:api','userIsAdmin']],function(){
	Route::put('products/{product}',[\App\Http\Controllers\API\Products\ProductController::class,'update']);
	Route::delete('products/{product}',[\App\Http\Controllers\API\Products\ProductController::class,'destroy']);
});


Route::get('products',[\App\Http\Controllers\API\Products\ProductController::class,'index']);
Route::get('product/{id}',[\App\Http\Controllers\API\Products\ProductController::class,'show'])->name('products.show');
Route::get('products/{product}/{slug}',[\App\Http\Controllers\API\Products\ProductController::class,'show']);

Route::get('categories',[\App\Http\Controllers\API\Categories\CategoriesController::class,'index']);

Route::post('carts',[\App\Http\Controllers\API\Cart\CartController::class,'store']);

Route::group(['middleware'=>['set_shoppingCart']],function(){
	Route::post('carts/{cart_id}/items',[\App\Http\Controllers\API\Cart\CartController::class,'addItem']);
	Route::get('carts/{cart_id}',[\App\Http\Controllers\API\Cart\CartController::class,'show']);
	 Route::delete('carts/{cart_id}/items/{item_id}',[\App\Http\Controllers\API\Cart\CartController::class,'removeItem']);
});

