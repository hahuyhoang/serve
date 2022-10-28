<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/form', [\App\Http\Controllers\Admin\SettingBannerController::class, 'formStyle'])->name('formStyle');
    Route::get('/', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('getLoginAdmin');
    Route::post('/', [\App\Http\Controllers\Admin\AuthController::class, 'postLogin'])->name('postLoginAdmin');
    Route::get('/admin-register', [\App\Http\Controllers\Admin\AuthController::class, 'getRegister'])->name('getRegister');
    Route::post('/admin-register', [\App\Http\Controllers\Admin\AuthController::class, 'postRegister'])->name('postRegister');

    Route::group(['middleware' => 'adminLogin'], function () {
        Route::group(['prefix' => 'products'], function () {
            Route::get('/list', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.list');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
            Route::post('/update/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
            Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
            Route::post('/store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
            Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.destroy');
        });
        Route::resource('users', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('brand', BrandController::class);

        /*setting*/
		Route::prefix("setting")->group(function(){
            Route::get('/banner-app', [\App\Http\Controllers\Admin\SettingBannerController::class, 'getListBannerApp'])->name('admin.getListBannerApp');
            Route::post('/create-banner-app', [\App\Http\Controllers\Admin\SettingBannerController::class, 'createBannerApp'])->name('admin.createBannerApp');
            Route::post('/delete-banner-app', [\App\Http\Controllers\Admin\SettingBannerController::class, 'deleteBannerApp'])->name('admin.deleteBannerApp');
		});

        Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
    });
});