<?php

use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\IndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::prefix('activities')->name('activities.')->group(function () {
        Route::get('data', [ActivityController::class, 'data'])
            ->name('data');

        Route::post('store', [ActivityController::class, 'store'])->name('store');
    });
});
