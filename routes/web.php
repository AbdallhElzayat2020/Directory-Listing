<?php

use App\Http\Controllers\Frontend\{
    AgentListingController,
    AgentListingImgGalleryController,
    AgentListingScheduleController,
    AgentListingVideoGalleryController,
    DashboardController,
    ProfileController,
    HomeController,
    PasswordController,
};

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

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth']], function () {


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password-update', [PasswordController::class, 'update'])->name('password.update');


    /* ------- Listing Routes -------  */
    Route::resource('listings', AgentListingController::class);

    /* Listing Image Gallery Routes */
    Route::get('/listings/{listing}/gallery-images', [AgentListingImgGalleryController::class, 'index'])
        ->name('listings.img-gallery.index');

    Route::post('/listings/{listing}/gallery-images', [AgentListingImgGalleryController::class, 'store'])
        ->name('listings.img-gallery.store');

    Route::delete('/listings/{listing}/gallery-images/{image}', [AgentListingImgGalleryController::class, 'destroy'])
        ->name('listings.img-gallery.destroy');


    /* Listing Video Gallery Routes */
    Route::get('/listings/{listing}/gallery-videos', [AgentListingVideoGalleryController::class, 'index'])
        ->name('listings.videos-gallery.index');

    Route::post('/listings/{listing}/gallery-videos', [AgentListingVideoGalleryController::class, 'store'])
        ->name('listings.videos-gallery.store');

    Route::delete('/listings/{listing}/gallery-videos/{video}', [AgentListingVideoGalleryController::class, 'destroy'])
        ->name('listings.videos-gallery.destroy');

    /* Listing schedule Routes */
    Route::prefix('listings/{listing}/schedules')
        ->name('listings.schedules.')
        ->controller(AgentListingScheduleController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{schedule}/edit', 'edit')->name('edit');
            Route::put('/{schedule}', 'update')->name('update');
            Route::delete('/{schedule}', 'destroy')->name('destroy');
        });

});

// Auth Routes for basic user
require __DIR__ . '/auth.php';
