<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\OilChangeController;
use App\Http\Controllers\Admin\PenaltyController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => AuthController::class], function () {
    Route::get('/', 'check')->name('check');
    Route::get('/custom-logout', 'logout')->name('custom.logout');
});

Route::group([
    'prefix' => '/',
    'middleware' => [
        'auth:sanctum',
        'refresh_cars',
        'role:admin,seating_manager,mechanic,accountant,investor,manager',
    ],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/contract/rent', [ContractController::class, 'contractRent'])->name('contract.rent');
    Route::get('/contract/rent-with-buy', [ContractController::class, 'contractRentWithBuy'])->name('contract.rent.with.buy');

    Route::group(['prefix' => '/users', 'controller' => UserController::class], function () {
        Route::get('/', 'index')->name('users.index');
        Route::post('/', 'store')->name('users.store')->middleware('check_permissions');
        Route::get('/create', 'create')->name('users.create');
        Route::get('/{id}', 'show')->name('users.show');
        Route::post('/{id}', 'update')->name('users.update')->middleware(['role:admin', 'check_permissions']);
        Route::get('/{id}/delete', 'delete')->name('users.delete')->middleware(['role:admin', 'check_permissions']);
    });

    Route::group(['prefix' => '/cars', 'controller' => CarController::class], function () {
        Route::get('/', 'index')->name('cars.index');
        Route::post('/', 'store')->name('cars.store')->middleware('check_permissions');
        Route::get('/create', 'create')->name('cars.create');
        Route::get('/{id}', 'show')->name('cars.show');
        Route::post('/{id}', 'update')->name('cars.update')->middleware('check_permissions');
        Route::post('/{id}/status', 'status')->name('cars.status');
        Route::get('/{id}/delete', 'delete')->name('cars.delete')->middleware('check_permissions');
    });

    Route::group(['prefix' => '/oil-changes', 'controller' => OilChangeController::class], function () {
        Route::get('/', 'index')->name('oilchanges.index');
        Route::post('/', 'store')->name('oilchanges.store')->middleware('check_permissions');
        Route::get('/create', 'create')->name('oilchanges.create');
        Route::get('/{id}', 'show')->name('oilchanges.show');
        Route::post('/{id}', 'update')->name('oilchanges.update')->middleware('check_permissions');
        Route::get('/{id}/delete', 'delete')->name('oilchanges.delete')->middleware('check_permissions');
    });

    Route::group(['prefix' => '/rents', 'controller' => RentController::class], function () {
        Route::get('/', 'index')->name('rents.index');
        Route::post('/', 'store')->name('rents.store')->middleware('check_permissions');
        Route::get('/create', 'create')->name('rents.create');
        Route::get('/{id}', 'show')->name('rents.show');
        Route::post('/{id}', 'update')->name('rents.update')->middleware('check_permissions');
        Route::get('/{id}/delete', 'delete')->name('rents.delete')->middleware('check_permissions');
    });

    Route::group(['prefix' => '/penalties', 'controller' => PenaltyController::class], function () {
        Route::get('/', 'index')->name('penalties.index');
        Route::post('/', 'store')->name('penalties.store')->middleware('check_permissions');
        Route::get('/create', 'create')->name('penalties.create');
        Route::get('/{id}', 'show')->name('penalties.show');
        Route::post('/{id}', 'update')->name('penalties.update')->middleware('check_permissions');
        Route::get('/{id}/delete', 'delete')->name('penalties.delete')->middleware('check_permissions');
    });

    Route::group(['prefix' => '/employees', 'middleware' => ['role:admin'], 'controller' => EmployeeController::class], function () {
        Route::get('/', 'index')->name('employees.index');
        Route::post('/', 'store')->name('employees.store');
        Route::get('/create', 'create')->name('employees.create');
        Route::get('/permissions', 'permissions')->name('employees.permissions');
        Route::post('/permissions', 'updatePermissions')->name('employees.permissions.update');
        Route::get('/{id}', 'show')->name('employees.show');
        Route::post('/{id}', 'update')->name('employees.update');
        Route::get('/{id}/delete', 'delete')->name('employees.delete');
    });

    Route::group(['prefix' => '/debts', 'middleware' => ['role:admin'], 'controller' => DebtController::class], function () {
        Route::get('/', 'index')->name('debts.index');
        Route::post('/', 'store')->name('debts.store');
        Route::get('/create', 'create')->name('debts.create');
        Route::get('/{id}', 'show')->name('debts.show');
        Route::post('/{id}', 'update')->name('debts.update');
        Route::get('/{id}/delete', 'delete')->name('debts.delete');
    });
});
