<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::get('search', [ProductController::class, 'search'])->name('search');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {    
    Route::prefix('shopping')->name('shopping.')->group(function () {
        Route::get('show/{id}', [ShoppingController::class, 'show'])->name('show');
        Route::get('search/{categoryId}', [ShoppingController::class, 'search'])->name('search');
    });
});


require __DIR__ . '/auth.php';
