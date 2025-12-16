<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AnalyticsController;
use App\Models\File;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk/{id}/detail', [HomeController::class, 'show'])->name('produk.detail');
Route::get('/kategori', [HomeController::class, 'kategori'])->name('kategori.index');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Logout Route (Authenticated Only)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // ========== DASHBOARD ==========
    Route::get('/dashboard', function () { 
        return view('dashboard'); 
    })->name('dashboard');

    // ========== PROFILE ==========
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    
    // ========== PRODUK (Product CRUD) ==========
    Route::resource('produk', ProdukController::class);
    
    // ========== KATEGORI (Category Management) ==========
    Route::resource('kategori', KategoriController::class)->only(['index', 'store', 'destroy']);

    // ========== PESANAN/TRANSAKSI (Orders) ==========
    Route::prefix('pesanan')->name('pesanan.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::patch('/{id}', [TransaksiController::class, 'updateStatus'])->name('update');
    });

    // ========== NOTIFICATIONS ==========
    Route::prefix('notifications')->name('notifications.')->group(function () {
        // Main notification page
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        
        // AJAX routes
        Route::get('/recent', [NotificationController::class, 'getRecent'])->name('recent');
        Route::get('/unread-count', [NotificationController::class, 'getUnreadCount'])->name('unread-count');
        
        // Mark as read
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
        
        // Delete
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
        Route::delete('/', [NotificationController::class, 'destroyAll'])->name('destroy-all');
    });

    // ========== ANALYTICS ==========
    Route::prefix('analytics')->name('analytics.')->group(function () {
        // Main analytics dashboard
        Route::get('/', [AnalyticsController::class, 'index'])->name('index');
        
        // Export
        Route::get('/export', [AnalyticsController::class, 'export'])->name('export');
        
        // AJAX routes for charts (optional)
        Route::get('/sales-data', [AnalyticsController::class, 'getSalesDataAjax'])->name('sales-data');
        Route::get('/top-products', [AnalyticsController::class, 'getTopProductsAjax'])->name('top-products');
    });
});

/*
|--------------------------------------------------------------------------
| File Handler Route
|--------------------------------------------------------------------------
*/
Route::get('/files/{id}/{action}', function ($id, $action) {
    $file = File::findOrFail($id);
    return $file->handleAction($action);
})->name('files.action');