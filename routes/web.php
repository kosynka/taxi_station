<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OilChangeController;
use App\Http\Controllers\Admin\PenaltyController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'refresh_cars', 'controller' => AuthController::class], function () {
    Route::get('/', 'check')->name('check');
    Route::get('/custom-logout', 'logout')->name('custom.logout');
});

Route::group(['prefix' => '/', 'middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/contract', [ContractController::class, 'contract'])->name('contract');

    Route::group(['prefix' => '/users', 'controller' => UserController::class], function () {
        Route::get('/', 'index')->name('users.index');
        Route::post('/', 'store')->name('users.store');
        Route::get('/create', 'create')->name('users.create');
        Route::get('/{id}', 'show')->name('users.show');
        Route::post('/{id}', 'update')->name('users.update');
        Route::get('/{id}/delete', 'delete')->name('users.delete');
    });

    Route::group(['prefix' => '/cars', 'middleware' => 'refresh_cars', 'controller' => CarController::class], function () {
        Route::get('/', 'index')->name('cars.index');
        Route::post('/', 'store')->name('cars.store');
        Route::get('/create', 'create')->name('cars.create');
        Route::get('/{id}', 'show')->name('cars.show');
        Route::post('/{id}', 'update')->name('cars.update');
        Route::get('/{id}/delete', 'delete')->name('cars.delete');
    });

    Route::group(['prefix' => '/oil-changes', 'controller' => OilChangeController::class], function () {
        Route::get('/', 'index')->name('oilchanges.index');
        Route::post('/', 'store')->name('oilchanges.store');
        Route::get('/create', 'create')->name('oilchanges.create');
        Route::get('/{id}', 'show')->name('oilchanges.show');
        Route::post('/{id}', 'update')->name('oilchanges.update');
        Route::get('/{id}/delete', 'delete')->name('oilchanges.delete');
    });

    Route::group(['prefix' => '/rents', 'middleware' => 'refresh_cars', 'controller' => RentController::class], function () {
        Route::get('/', 'index')->name('rents.index');
        Route::post('/', 'store')->name('rents.store');
        Route::get('/create', 'create')->name('rents.create');
        Route::get('/{id}', 'show')->name('rents.show');
        Route::post('/{id}', 'update')->name('rents.update');
        Route::get('/{id}/delete', 'delete')->name('rents.delete');
    });

    Route::group(['prefix' => '/penalties', 'controller' => PenaltyController::class], function () {
        Route::get('/', 'index')->name('penalties.index');
        Route::post('/', 'store')->name('penalties.store');
        Route::get('/create', 'create')->name('penalties.create');
        Route::get('/{id}', 'show')->name('penalties.show');
        Route::post('/{id}', 'update')->name('penalties.update');
        Route::get('/{id}/delete', 'delete')->name('penalties.delete');
    });
});
