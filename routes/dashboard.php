<?php

use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\IndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::prefix('activities')->name('activities.')->group(function () {
        Route::get('data', [ActivityController::class, 'data'])
            ->name('data');

        Route::middleware(['role:super admin,user'])->post('store', [ActivityController::class, 'store'])->name('store');

        Route::middleware(['role:super admin'])->get('{activity}/edit', [ActivityController::class, 'edit'])->name('edit');

        Route::middleware(['role:super admin'])->put('update/{activity}', [ActivityController::class, 'update'])->name('update');

        Route::middleware(['role:super admin,admin'])->post('update-status', [ActivityController::class, 'updateStatus'])->name('updateStatus');

        Route::middleware(['role:super admin'])->delete('delete/{activity}', [ActivityController::class, 'destroy'])->name('delete');
    });

    Route::middleware(['role:super admin'])->prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');

        Route::get('data', [UserController::class, 'data'])
            ->name('data');

        Route::post('store', [UserController::class, 'store'])->name('store');

        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');

        Route::put('update/{user}', [UserController::class, 'update'])->name('update');

        Route::post('update-status', [UserController::class, 'updateStatus'])->name('updateStatus');

        Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('delete');
    });

    Route::middleware(['role:super admin'])->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');

        Route::post('store', [ProfileController::class, 'store'])->name('store');

    });

    Route::middleware(['role:super admin'])->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');

        Route::post('store', [SettingController::class, 'store'])->name('store');

    });
});
