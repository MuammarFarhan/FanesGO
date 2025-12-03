<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Models\File;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}/detail', [HomeController::class, 'show'])->name('produk.detail');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    
    Route::resource('produk', ProdukController::class);
    
    Route::resource('kategori', KategoriController::class)->only(['index', 'store', 'destroy']);
});

Route::get('/files/{id}/{action}', function ($id, $action) {
    $file = File::findOrFail($id);
    return $file->handleAction($action);
})->name('files.action');