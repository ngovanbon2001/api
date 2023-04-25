<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
   // Route::post('login', 'UserController@login');
    Route::post('/register', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);   
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout']);
    Route::post('/detail', [App\Http\Controllers\UserController::class, 'detailTest']);
    Route::post('/list', [App\Http\Controllers\UserController::class, 'list']);

    Route::get('/banner', [BannerController::class, 'index']);
    Route::post('/banner/add', [BannerController::class, 'store']);
    Route::post('/banner/update/{id}', [BannerController::class, 'update']);
    Route::get('/banner/show/{id}', [BannerController::class, 'show']);
    Route::get('/banner/delete/{id}', [BannerController::class, 'destroy']);
    Route::post('/banner/listFind', [BannerController::class, 'list']);

    Route::get('/test/{id}', [OrderController::class, 'show']);

    Route::get('/brand', [BrandController::class, 'index']);
    Route::post('/brand/add', [BrandController::class, 'store']);
    Route::post('/brand/update/{id}', [BrandController::class, 'update']);
    Route::get('/brand/show/{id}', [BrandController::class, 'show']);
    Route::get('/brand/delete/{id}', [BrandController::class, 'destroy']);

    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/product/add', [ProductController::class, 'store']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::get('/product/show/{id}', [ProductController::class, 'show']);
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy']);

    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category/add', [CategoryController::class, 'store']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::get('/category/show/{id}', [CategoryController::class, 'show']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order/add', [OrderController::class, 'store']);
    Route::post('/order/update/{id}', [OrderController::class, 'update']);
    Route::get('/order/show/{id}', [OrderController::class, 'show']);
    Route::get('/order/delete/{id}', [OrderController::class, 'destroy']);
});