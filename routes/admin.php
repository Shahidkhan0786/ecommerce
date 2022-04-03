<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BrandController;

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Route::get('/', function () {
    //     return view('admin.dashboard.index');
    // });
    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
    });
});

Route::group(['prefix'  =>   'admin/brands'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brands.index');
        Route::get('create', [BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::get('delete/{id}', [BrandController::class, 'destroy'])->name('admin.brands.delete');
    });
    // Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
    // Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
    // Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
    // Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
    // Route::post('/update', 'Admin\BrandController@update')->name('admin.brands.update');
    // Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');
});