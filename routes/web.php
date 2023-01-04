<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Settings\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/admin');

Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::put('users/{user}/status', [UserController::class, 'status'])->name('users.status');

    // Route Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    // Route Group Settings
    Route::prefix('settings')->as('settings.')->group(function () {
        Route::resource('roles', RoleController::class);
    });
});
require __DIR__.'/auth.php';
