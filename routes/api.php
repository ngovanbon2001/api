<?php

use App\Constants\Constants;
use App\Constants\StatusCodeMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

Route::get('/auth/google',  [App\Http\Controllers\UserController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback',  [App\Http\Controllers\UserController::class, 'handleGoogleCallback']);
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::post('login', 'UserController@login');
    Route::post('/register', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
});


Route::middleware(['auth:api'])->group(function () {
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

    Route::get('/image', [ImageController::class, 'index']);
    Route::post('/image/add', [ImageController::class, 'store']);
    Route::post('/image/update/{id}', [ImageController::class, 'update']);
    Route::get('/image/show/{id}', [ImageController::class, 'show']);
    Route::get('/image/delete/{id}', [ImageController::class, 'destroy']);
});

Route::post('/test1', function (Request $request) {

    $csrfToken = 'eyJpdiI6ImZcL0hZdFVFUmpXdkhvckVzTitwSjdBPT0iLCJ2YWx1ZSI6IkJ5dG1WN0FuUXc5WHlUNnNmcjFjaURLVk5rRk1WUTJxbkJudCtuTE1FRUhHWUNjV2VwVmZ0WnhUa0xQb0pUdWRuN0QyYzZaRW5VdVYwdjNcL0g5RWhKZz09IiwibWFjIjoiYWQ4MTIwMTE1ZDNhMzNjZjFjNDE4NTk1YjkyYzc3NzI2NjA2ZjIxMzc4NzE2MWZkNDdmYmZjOTU5ZmRkNWNhMyJ9';

    try {
        // Thực hiện yêu cầu POST tới hệ thống đích với CSRF token
        $response = Http::withHeaders([
            'XSRF-TOKEN' => $csrfToken,
            'Accept' => 'application/json',
        ])->post('https://ecohappygo.com/account/do-register', [
            'ismember' => 'enterprise',
            // Các trường dữ liệu khác
        ]);

        // Xử lý response
        dd($response);

        return [
            'code' => StatusCodeMessage::CODE_OK,
            'message' => StatusCodeMessage::getMessage(StatusCodeMessage::CODE_OK),
            'data' => [
                'create' => $response
            ]
        ];
    } catch (Exception $e) {
        dd($e);
        return [
            'code'    => StatusCodeMessage::CODE_FAIL,
            'message' => $e->getMessage(),
            'data'    => [
                'create' => $response
            ]
        ];
    }
});

Route::post('/loginSocial',  [App\Http\Controllers\UserController::class, 'loginSocial']);