<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TestimonialController;

// ==========================================
// 1. ROUTE PUBLIK
// ==========================================
Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/tentang', 'about')->name('front.about');
    Route::get('/layanan', 'services')->name('front.services');
    Route::get('/artikel', 'blogIndex')->name('front.blog.index');
});

// ==========================================
// 2. ROUTE AUTENTIKASI
// ==========================================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// ==========================================
// 3. ROUTE ADMIN (Terlindungi Middleware)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // A. Manajemen Artikel (Posts)
    Route::resource('posts', PostController::class)->except(['show']);
    Route::controller(PostController::class)->prefix('posts')->name('posts.')->group(function () {
        Route::post('/{post}/archive', 'archive')->name('archive');
        Route::post('/upload-image', 'uploadImage')->name('upload-image');
        Route::get('/media-library', 'listImages')->name('media-library');
    });

    // B. Manajemen Konten Beranda
    Route::prefix('beranda')->name('beranda.')->group(function () {
        Route::resource('hero', HeroController::class)->except(['show']);
        Route::resource('clients', ClientController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('portfolios', PortfolioController::class)->except(['show']);
        Route::resource('testimonials', TestimonialController::class)->except(['show']);
    });
});