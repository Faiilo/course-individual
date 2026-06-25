<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// О проекте
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Подписка
Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription');

// Архив редакций
Route::get('/archive/server1', [ArchiveController::class, 'server01'])->name('archive.server1');
Route::get('/archive/servers-234', [ArchiveController::class, 'servers234'])->name('archive.servers234');

// Новости
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Профиль (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Админ-панель (только для админов)
Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    // Главная админки
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Новости
    Route::get('/news', [AdminController::class, 'news'])->name('admin.news');
    Route::get('/news/create', [AdminController::class, 'newsCreate'])->name('admin.news.create');
    Route::post('/news/store', [AdminController::class, 'newsStore'])->name('admin.news.store');
    Route::get('/news/edit/{id}', [AdminController::class, 'newsEdit'])->name('admin.news.edit');
    Route::post('/news/update/{id}', [AdminController::class, 'newsUpdate'])->name('admin.news.update');
    Route::get('/news/delete/{id}', [AdminController::class, 'newsDelete'])->name('admin.news.delete');
    
    // Редакции
    Route::get('/archive/server1', [ArchiveController::class, 'server1'])->name('archive.server1');
Route::get('/archive/server01', [ArchiveController::class, 'server01'])->name('archive.server01');
    Route::get('/archive/server1', [ArchiveController::class, 'server1'])->name('archive.server1');
    Route::get('/archive/servers-234', [ArchiveController::class, 'servers234'])->name('archive.servers234');
    Route::get('/editorials/server1', [AdminController::class, 'editorialsServer1'])->name('admin.editorials.server1');
    Route::get('/editorials/servers234', [AdminController::class, 'editorialsServers234'])->name('admin.editorials.servers234');
    Route::get('/editorials/create', [AdminController::class, 'editorialCreate'])->name('admin.editorials.create');
    Route::post('/editorials/store', [AdminController::class, 'editorialStore'])->name('admin.editorials.store');
    Route::get('/editorials/edit/{id}', [AdminController::class, 'editorialEdit'])->name('admin.editorials.edit');
    Route::post('/editorials/update/{id}', [AdminController::class, 'editorialUpdate'])->name('admin.editorials.update');
    Route::get('/editorials/delete/{id}', [AdminController::class, 'editorialDelete'])->name('admin.editorials.delete');
    Route::get('/editorials/make-current/{id}', [AdminController::class, 'editorialMakeCurrent'])->name('admin.editorials.make-current');
    Route::post('/editorials/update-order', [AdminController::class, 'editorialUpdateOrder'])->name('admin.editorials.update-order');
    
    // Пользователи
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/toggle-subscription/{id}', [AdminController::class, 'userToggleSubscription'])->name('admin.users.toggle-subscription');
    Route::get('/users/toggle-admin/{id}', [AdminController::class, 'userToggleAdmin'])->name('admin.users.toggle-admin');
});

// Аутентификация (Breeze)
require __DIR__.'/auth.php';