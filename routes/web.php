<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GoodReceivedNoteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UnitController;
use App\Http\Middleware\CheckAdmin;
use App\Models\Supplier;
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
Route::prefix('auth')->group(function () {
    Route::get('login', [
        'as' => 'auth.index',
        'uses' => 'App\Http\Controllers\AuthController@index'
    ]);
    Route::post('login', [
        'as' => 'auth.login',
        'uses' => 'App\Http\Controllers\AuthController@login'
    ]);
    Route::get('logout', [
        'as' => 'auth.logout',
        'uses' => 'App\Http\Controllers\AuthController@logout'
    ]);
});

Route::middleware([CheckAdmin::class])->group(function () {
    Route::prefix('/')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::prefix('directory')->group(function () {
            Route::get('/supplier', [SupplierController::class, 'index'])->name('admin.directory.supplier');
            Route::get('/itemCategory', [CategoryController::class, 'index'])->name('admin.directory.category');
            Route::get('/unitOfMeasure', [UnitController::class, 'index'])->name('admin.directory.unit');
            Route::get('/item', [ItemController::class, 'index'])->name('admin.directory.item');
            Route::get('/setPrice', [PriceController::class, 'index'])->name('admin.directory.price');
            Route::get('/area', [AreaController::class, 'index'])->name('admin.directory.area');
            Route::get('/table', [TableController::class, 'index'])->name('admin.directory.table');
            Route::get('/ingredient', [IngredientController::class, 'index'])->name('admin.directory.ingredient');
        });

        Route::prefix('stock')->group(function () {
            Route::get('/grn', [GoodReceivedNoteController::class, 'index'])->name('admin.stock.grn');
        });

        Route::prefix('sys')->group(function () {
            Route::get('/role', [RoleController::class, 'index'])->name('admin.sys.role');
            Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.sys.employee');
        });

    });
});

Route::prefix('/cashier')->group(function () {

    Route::get('/', [CashierController::class, 'index'])->name('cashier');
    Route::get('/generate-dupe/{id}', [CashierController::class, 'printDupe'])->name('cashier.print-dupe');

});
