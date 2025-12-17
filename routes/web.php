<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| PUBLIC (FRONTEND / PENGUNJUNG)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/produk', [HomeController::class, 'produk'])
    ->name('produk.public');

Route::get('/produk/{id}', [HomeController::class, 'show'])
    ->name('produk.detail');

Route::get('/kategori', [HomeController::class, 'kategori'])
    ->name('kategori.index');

Route::get('/tentang-kami', [HomeController::class, 'about'])
    ->name('about');

Route::get('/kontak', [HomeController::class, 'contact'])
    ->name('contact');


/*
|--------------------------------------------------------------------------
| AUTH ADMIN (LOGIN / LUPA PASSWORD)
|--------------------------------------------------------------------------
| guest : hanya bisa diakses jika BELUM login
*/
Route::middleware('guest')->group(function () {

    // LOGIN ADMIN
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    // LUPA PASSWORD
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->middleware('guest')
        ->name('password.update');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
| auth : hanya admin yang sudah login
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {

    Route::get('/', fn() => view('dashboard.index'))->name('dashboard');

    Route::resource('produk', ProdukController::class);

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.show');

    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');
});
