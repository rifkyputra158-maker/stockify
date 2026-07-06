<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockTransactionController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

  Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
});

Route::middleware(['auth', 'role:admin,manajer_gudang,staff_gudang'])->group(function () {
    Route::get('stock-transactions', [StockTransactionController::class, 'index'])->name('stock-transactions.index');
    Route::post('stock-transactions/in', [StockTransactionController::class, 'storeIn'])->name('stock-transactions.in');
    Route::post('stock-transactions/out', [StockTransactionController::class, 'storeOut'])->name('stock-transactions.out');
});
});

Route::middleware(['auth', 'role:admin,manajer_gudang'])->group(function () {
    // route yang boleh diakses admin & manajer gudang
});

Route::middleware(['auth', 'role:admin,manajer_gudang,staff_gudang'])->group(function () {
    // route yang boleh diakses semua role login
});

require __DIR__.'/auth.php';