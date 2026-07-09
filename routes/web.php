<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/* --------------------- public Routes --------------------- */
Route::get('/', [HomeController::class, 'index'])->name('home');


/* --------------------- Protected Routes --------------------- */

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password-update', [PasswordController::class, 'update'])->name('password.update');

});

// Auth Routes for basic user
require __DIR__ . '/auth.php';
