<?php

use App\Http\Controllers\Frontend\AgentListingController;
use App\Http\Controllers\Frontend\AgentListingImgGalleryController;
use App\Http\Controllers\Frontend\AgentListingScheduleController;
use App\Http\Controllers\Frontend\AgentListingVideoGalleryController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ListingController;
use App\Http\Controllers\Frontend\PasswordController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
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


/*
 * --------- install breeze for auth ----------
 * composer require laravel/breeze:^1.28 --dev
 * php artisan breeze:install
 * npm install
 * npm run dev
 *
 * ---------- install laravel flasher for flash messages ----------
 * composer require php-flasher/flasher-laravel:^1.15
 * */

/* --------------------- public Routes --------------------- */

Route::get('/', [HomeController::class, 'index'])->name('home');

/* ---- Listings Routes ---- */
Route::get('listing-menu/{slug}', [ListingController::class, 'listings'])->name('listing-menu');
Route::get('listing-details/{slug}', [ListingController::class, 'viewDetails'])->name('listing-details');
Route::get('listing-modal/{id}', [ListingController::class, 'showModal'])->name('listing.show-modal');
Route::get('all-listings', [ListingController::class, 'viewAll'])->name('all-listings');


/* --------------------- Protected Routes --------------------- */

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth']
], function () {


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password-update', [PasswordController::class, 'update'])->name('password.update');


    /* ---- listings Routes ----- */
    Route::resource('listings', AgentListingController::class);

    /* Listing Image Gallery Routes */
    Route::get('listings/{listing}/gallery-images', [AgentListingImgGalleryController::class, 'index'])
        ->name('listings.gallery.index');

    Route::post('listings/{listing}/gallery-images', [AgentListingImgGalleryController::class, 'store'])
        ->name('listings.gallery.store');

    Route::delete('/listings/{listing}/gallery-images/{image}', [AgentListingImgGalleryController::class, 'destroy'])
        ->name('listings.gallery.destroy');

    /* Listing Video Gallery Routes */
    Route::get('/listings/{listing}/gallery-videos', [AgentListingVideoGalleryController::class, 'index'])
        ->name('listings.videos-gallery.index');

    Route::post('/listings/{listing}/gallery-videos', [AgentListingVideoGalleryController::class, 'store'])
        ->name('listings.videos-gallery.store');

    Route::delete('/listings/{listing}/gallery-videos/{video}', [AgentListingVideoGalleryController::class, 'destroy'])
        ->name('listings.videos-gallery.destroy');


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


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])
//        ->name('profile.edit');
//
//    Route::patch('/profile', [ProfileController::class, 'update'])
//        ->name('profile.update');
//
//    Route::delete('/profile', [ProfileController::class, 'destroy'])
//        ->name('profile.destroy');
//});

require __DIR__ . '/auth.php';
