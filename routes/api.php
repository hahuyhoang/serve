<?php

use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\SettingBannerController;
use App\Http\Controllers\api\UserController;
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
Route::post("login", [UserController::class, 'login']);
Route::post("register", [UserController::class, 'register']);
Route::post("check-register-code", [UserController::class, 'CheckRegisterCode']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    //All secure URL's
    Route::group(['prefix' => 'products'], function () {
        Route::get("/list", [ProductController::class, 'index']);
        Route::get("/item/{id}", [ProductController::class, 'getProduct']);
        Route::get("/filter-search", [ProductController::class, 'filterSearch']);
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get("/list", [CategoryController::class, 'index']);
    });
    Route::group(['prefix' => 'brand'], function () {
        Route::get("/list", [BrandController::class, 'index']);
    });
    Route::group(['prefix' => 'user'], function () {
        Route::post("/avatar", [UserController::class, 'createEditAvatar']);
        Route::post("/update", [UserController::class, 'updateUser']);
    });
    // Route::resource('user', UserController::class);
    Route::resource('banner', SettingBannerController::class);
    Route::resource('orders', OrderController::class);
    Route::post("logout", [UserController::class, 'logout']);
});


