<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::prefix('painel')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::get('login', [LoginController::class, 'index'])->name('index');
    Route::post('login', [LoginController::class, 'login_action'])->name('login');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register_action'])->name('register_action');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profilesave', [ProfileController::class, 'save'])->name('profile.save');

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::put('settingssave', [SettingController::class, 'save'])->name('settings.save');

    Route::get('pages', [PageController::class, 'index'])->name('pages');
    Route::resource('pages', PageController::class);
});
