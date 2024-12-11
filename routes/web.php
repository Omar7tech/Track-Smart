<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Route::middleware(["guest"])->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/loginPost", [AuthController::class, "loginPost"])->name("loginPost");
});


Route::middleware(["auth"])->group(function () {

    Route::middleware("can:admin")->group(function () {
        Route::resource("users", UserController::class);
    });

    Route::middleware(["can:employee"])->group(function () {
        Route::resource("categories", CategoryController::class);
        Route::resource("products", ProductController::class);
        Route::get('/sales/{sale}/print', [SaleController::class, 'printSalePdf'])->name('sales.printSale');
        Route::get("/sales", [SaleController::class, "index"])->name("sales.index");
        Route::post('/sales/{product}', [SaleController::class, 'create'])->name('sales.create');
        Route::get('/stock', [ProductController::class, 'stockIndex'])->name('stock.index');
        Route::post('/stock/add/{product}', [ProductController::class, 'addStock'])->name('stock.add');
        Route::post('/stock/minus/{product}', [ProductController::class, 'minusStock'])->name('stock.minus');
        Route::post('/stock/reset/{product}', [ProductController::class, 'resetStock'])->name('stock.reset');
    });

    Route::middleware('can:analyst')->controller(StatisticsController::class)->name("stats.")->prefix("/stats")->group(function () {
        Route::get("/users", 'users')->name('users');
        Route::get('/categories', 'categories')->name('categories');
        Route::get('/products', 'products')->name('products');
        Route::get('/money', 'money')->name('money');
        Route::get('/stock', 'stock')->name('stock');
        Route::get('/expiry', 'expiry')->name('expiry');
        Route::get('/expiry/print-expired-pdf', 'printExpiredProductsPDF')->name('printExpiredProductsPDF');
        Route::get('/stock/print-low-stock-pdf', 'printLowStockPDF')->name('printLowStockPDF');
        Route::get('/reports' , 'reports')->name('reports');
        Route::get('/reports/comprehensive', 'generateComprehensiveReport')->name('reports.comprehensive');
    });


    Route::post("change-password", [ProfileController::class, "changePassword"])->name("changePassword");
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});
