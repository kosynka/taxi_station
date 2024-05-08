<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }

    return redirect('login');
});

Route::group(['prefix' => '/', 'middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => '/users', 'controller' => UserController::class], function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/{id}', 'show')->name('users.show');
    });

    Route::group(['prefix' => '/cars', 'controller' => CarController::class], function () {
        Route::get('/', 'index')->name('cars.index');
        Route::post('/', 'store')->name('cars.store');
        Route::get('/create', 'create')->name('cars.create');
        Route::get('/{id}', 'show')->name('cars.show');
        Route::post('/{id}', 'update')->name('cars.update');
        Route::get('/{id}/delete', 'delete')->name('cars.delete');
    });
});
