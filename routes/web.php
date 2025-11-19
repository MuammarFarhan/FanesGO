<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Models\File;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}', [HomeController::class, 'show'])->name('produk.detail');

// Otentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Baris 20: PASTIKAN AKHIRNYA ADA SEMICOLON (;)

// Halaman Admin & Terproteksi
Route::middleware(['auth'])->group(function () { // Baris 23: PASTIKAN AKHIRNYA ADA SEMICOLON (;)
    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Middleware untuk Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('produk', ProdukController::class)->except(['show']);
        Route::resource('kategori', KategoriController::class)->only(['index', 'store', 'destroy']);
    });
});

// Route untuk Stream/Download File
Route::get('/files/{id}/{action}', function ($id, $action) {
    $file = File::findOrFail($id);
    return $file->handleAction($action);
})->name('files.action');
