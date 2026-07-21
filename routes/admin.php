<?php


use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\ListingImageGalleryController;
use App\Http\Controllers\Admin\ListingVideoController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasswordController;

/* --------------------- public Routes --------------------- */

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'guest'],
    function () {

        /* ------- Login Route ------- */
        Route::get('/login', [AdminAuthController::class, 'LoginForm'])->name('show.login');


        /* ------- forget-password Route ------- */
        Route::get('forget-password', [AdminAuthController::class, 'passwordRequest'])->name('password.request');
    });


/* --------------------- Protected Routes --------------------- */
Route::group(['prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'user.type:admin']],
    function () {

        /*  --- dashboard Route --- */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*  --- Profile Routes --- */
        Route::get('profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('change-password', [PasswordController::class, 'updatePassword'])
            ->name('profile.change-password');

        /*  --- Heroes Routes --- */
        Route::get('hero-section', [HeroController::class, 'index'])
            ->name('hero.index');

        Route::put('hero-section', [HeroController::class, 'update'])
            ->name('hero.update');

        /* Category Routes */
        Route::resource('categories', CategoryController::class);

        /* Locations Routes */
        Route::resource('locations', LocationController::class);

        /* Amenities Routes */
        Route::resource('amenities', AmenityController::class);

        /* Listings Routes */
        Route::resource('listings', ListingController::class);

        /* Listing Image Gallery Routes */

        Route::get('/listings/{listing}/gallery-images', [ListingImageGalleryController::class, 'index'])
            ->name('listings.gallery.index');

        Route::post('/listings/{listing}/gallery-images', [ListingImageGalleryController::class, 'store'])
            ->name('listings.gallery.store');

        Route::delete('/listings/{listing}/gallery-images/{image}', [ListingImageGalleryController::class, 'destroy'])
            ->name('listings.gallery.destroy');


        /* Listing Video Gallery Routes */
        Route::get('/listings/{listing}/gallery-videos', [ListingVideoController::class, 'index'])
            ->name('listings.videos-gallery.index');

        Route::post('/listings/{listing}/gallery-videos', [ListingVideoController::class, 'store'])
            ->name('listings.videos-gallery.store');

        Route::delete('/listings/{listing}/gallery-videos/{video}', [ListingVideoController::class, 'destroy'])
            ->name('listings.videos-gallery.destroy');

    });
