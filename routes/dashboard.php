<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;


Route::group(
    [
        'middleware' => ['auth'],
        'as' => 'dashboard.',
        'prefix' => 'dashboard'
    ],
    function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('categories', CategoryController::class);
    }
);
