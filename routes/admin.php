<?php


use App\Http\Controllers\Admin\ProfileController;
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

        /*  --- Profile Routes --- */
        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::get('profile/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete-avatar');
        Route::get('profile/delete-banner', [ProfileController::class, 'deleteBanner'])->name('profile.delete-banner');
    });
