<?php


/* ======= admin Auth ======= */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;


/* --------------------- public Routes --------------------- */

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'guest'],
    function () {

        Route::get('/login', [AdminAuthController::class, 'LoginForm'])->name('show.login');
        Route::get('forget-password', [AdminAuthController::class, 'passwordRequest'])->name('password.request');
    });

/* --------------------- Protected Routes --------------------- */
Route::group(['prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'user.type:admin']],
    function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });
