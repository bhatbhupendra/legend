<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WellwayProductController;
use App\Http\Controllers\IgloohomeProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/dashboard/notes', [DashboardController::class, 'storeNote'])
        ->name('dashboard.notes.store');

    Route::delete('/dashboard/notes/{note}', [DashboardController::class, 'destroyNote'])
        ->name('dashboard.notes.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // List users
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    // Create form
    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    // Store user
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    // Edit form
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    // Update user
    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    // Delete user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');
});

//product routes
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class,'products'])->name('products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
});

//wellway routes
Route::middleware(['auth'])->group(function () {
    Route::get('/wellway', [WellwayProductController::class, 'index'])->name('wellway.index');
    Route::get('/wellway/create', [WellwayProductController::class, 'create'])->name('wellway.create');
    Route::get('/wellway/products',[WellwayProductController::class,'products'])->name('wellway.products');
    Route::post('/wellway', [WellwayProductController::class, 'store'])->name('wellway.store');

    Route::get('/wellway/movements/all', [WellwayProductController::class, 'allMovements'])->name('wellway.allMovements');
    Route::patch('/wellway/movements/{movement}/status', [WellwayProductController::class, 'updateMovementStatus'])->name('wellway.movements.updateStatus');
    Route::get('/wellway/movements/all', [WellwayProductController::class, 'allMovements'])->name('wellway.movements.all');
    Route::get('/wellway-movements', [WellwayProductController::class, 'allMovements'])->name('wellway.allMovements');
    Route::get('/wellway/{wellway}/edit', [WellwayProductController::class, 'edit'])->name('wellway.edit');
    Route::put('/wellway/{wellway}', [WellwayProductController::class, 'update'])->name('wellway.update');
    Route::delete('/wellway/{wellway}', [WellwayProductController::class, 'destroy'])->name('wellway.destroy');

    Route::get('/wellway/{wellway}/stock-in', [WellwayProductController::class, 'stockInForm'])->name('wellway.stockin.form');
    Route::post('/wellway/{wellway}/stock-in', [WellwayProductController::class, 'stockIn'])->name('wellway.stockin');

    Route::get('/wellway/{wellway}/stock-out', [WellwayProductController::class, 'stockOutForm'])->name('wellway.stockout.form');
    Route::post('/wellway/{wellway}/stock-out', [WellwayProductController::class, 'stockOut'])->name('wellway.stockout');

    Route::get('/wellway/{wellway}/movements', [WellwayProductController::class, 'movements'])->name('wellway.movements');
    
    //for editing movement details (e.g. correcting qty, updating shipment info, etc)
    Route::get('/wellway/movements/{movement}/edit', [WellwayProductController::class, 'editMovement'])
    ->name('wellway.movements.edit');
    Route::put('/wellway/movements/{movement}', [WellwayProductController::class, 'updateMovement'])
    ->name('wellway.movements.update');
});

// igloohome routes
Route::middleware(['auth'])->prefix('igloohome')->group(function () {
    Route::get('/', [IgloohomeProductController::class,'index'])->name('igloohome.index');
    Route::get('/create',[IgloohomeProductController::class,'create'])->name('igloohome.create');
    Route::get('/products',[IgloohomeProductController::class,'products'])->name('igloohome.products');
    Route::post('/store', [IgloohomeProductController::class, 'store'])->name('igloohome.store');

    Route::get('/igloohome/{igloohome}/edit', [IgloohomeProductController::class, 'edit'])->name('igloohome.edit');
    Route::put('/igloohome/{igloohome}', [IgloohomeProductController::class, 'update'])->name('igloohome.update');
    Route::delete('/igloohome/{igloohome}', [IgloohomeProductController::class, 'destroy'])->name('igloohome.destroy');

    Route::get('/{igloohome}/stock-in', [IgloohomeProductController::class, 'stockInForm'])->name('igloohome.stockin.form');
    Route::post('/{igloohome}/stock-in', [IgloohomeProductController::class, 'stockIn'])->name('igloohome.stockin');

    Route::get('/{igloohome}/stock-out', [IgloohomeProductController::class, 'stockOutForm'])->name('igloohome.stockout.form');
    Route::post('/{igloohome}/stock-out', [IgloohomeProductController::class, 'stockOut'])->name('igloohome.stockout');

    Route::get('/{igloohome}/movements', [IgloohomeProductController::class, 'movements'])->name('igloohome.movements');

    Route::get('/movements/all', [IgloohomeProductController::class, 'allMovements'])->name('igloohome.allMovements');
    Route::patch('/movements/{movement}/status', [IgloohomeProductController::class, 'updateMovementStatus'])->name('igloohome.movements.updateStatus');

    Route::get('/movements/{movement}/edit', [IgloohomeProductController::class, 'editMovement'])->name('igloohome.movements.edit');
    Route::put('/movements/{movement}', [IgloohomeProductController::class, 'updateMovement'])->name('igloohome.movements.update');

    Route::get('/igloohome/products/export/excel', [IgloohomeProductController::class, 'exportIgloohomeProductsExcel'])
    ->name('igloohome.products.export.excel');
    Route::get('/igloohome/movements/export/excel', [IgloohomeProductController::class, 'exportIgloohomeMovementsExcel'])
    ->name('igloohome.movements.export.excel');

    Route::get('igloohome/reports/monthly/pdf', [IgloohomeProductController::class, 'monthlyPdf'])->name('igloohome.reports.monthly.pdf');
});

require __DIR__.'/auth.php';