<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PostController as UserPostController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post}', [HomeController::class, 'show'])->name('posts.show');

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
});
