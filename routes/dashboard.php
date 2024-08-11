<?php

use App\Http\Controllers\Dashboard\IndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
});
