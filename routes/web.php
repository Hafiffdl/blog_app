<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\User\FaqController as UserFaqController;
use App\Http\Controllers\KiController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post}', [HomeController::class, 'show'])->name('posts.show');

Route::get('/kekayaan-intelektual', [KiController::class, 'index'])->name('ki.index');
Route::get('/ki/create/{id}', [KiController::class, 'create'])->name('ki.create');
Route::post('/ki/store', [KiController::class, 'store'])->name('ki.store')->middleware('auth');
Route::get('/ki/my-submissions', [KiController::class, 'mySubmissions'])->name('ki.my-submissions')->middleware('auth');

Route::middleware(['auth'])->prefix('ki')->name('ki.')->group(function () {
    Route::get('/{id}/edit', [KiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [KiController::class, 'update'])->name('update');
    Route::delete('/{id}', [KiController::class, 'destroy'])->name('destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::prefix('posts')->group(function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('admin.posts.index');
        Route::get('/{post}', [AdminPostController::class, 'show'])->name('admin.posts.show');
        Route::get('/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
        Route::post('/{post}/approve', [AdminPostController::class, 'approve'])->name('admin.posts.approve');
        Route::post('/{post}/reject', [AdminPostController::class, 'reject'])->name('admin.posts.reject');
    });

    Route::prefix('faqs')->group(function () {
        Route::get('/', [AdminFaqController::class, 'index'])->name('admin.faqs.index');
        Route::post('/', [AdminFaqController::class, 'store'])->name('admin.faqs.store');
        Route::put('/{id}', [AdminFaqController::class, 'update'])->name('admin.faqs.update');
        Route::delete('/{id}', [AdminFaqController::class, 'destroy'])->name('admin.faqs.destroy');
    });
});

Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::resource('posts', UserPostController::class)->names([
        'index' => 'user.posts.index',
        'create' => 'user.posts.create',
        'store' => 'user.posts.store',
        'show' => 'user.posts.show',
        'edit' => 'user.posts.edit',
        'update' => 'user.posts.update',
        'destroy' => 'user.posts.destroy',
    ]);

    Route::get('/faqs', [UserFaqController::class, 'index'])->name('user.faqs.index');
});
