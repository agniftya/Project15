<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;

// Halaman utama (public)
Route::get('/', function () {
    return view('welcome');
});

// Auth (login & register)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {
    // Dashboard pengguna
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk contoh
    Route::get('/add-sample-products', [CartController::class, 'storeSampleProducts'])->name('products.sample');

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

    // Checkout
    Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
    
    // (Optional) Clear keranjang saat testing
    Route::get('/clear-cart', function () {
        session()->forget('cart');
        return redirect()->back()->with('info', 'Keranjang berhasil dikosongkan.');
    })->name('cart.clear');
});
