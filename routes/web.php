<?php

use App\Http\Controllers\Frontend\AgentListingController;
use App\Http\Controllers\Frontend\AgentListingImgGalleryController;
use App\Http\Controllers\Frontend\AgentListingScheduleController;
use App\Http\Controllers\Frontend\AgentListingVideoGalleryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\ListingController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\PasswordController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;


/* --------------------- public Routes --------------------- */

Route::get('/', [HomeController::class, 'index'])->name('home');

/* ---- Listings Routes ---- */
Route::get('listing-menu/{slug}', [ListingController::class, 'listings'])->name('listing-menu');
Route::get('listing-details/{slug}', [ListingController::class, 'viewDetails'])->name('listing-details');
Route::get('listing-modal/{id}', [ListingController::class, 'showModal'])->name('listing.show-modal');
Route::get('all-listings', [ListingController::class, 'viewAll'])->name('all-listings');
Route::get('packages', [PackageController::class, 'index'])->name('packages');
Route::get('checkout/{slug}/{id}', [CheckoutController::class, 'index'])->name('checkout.index');


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

/* -------- Payment Routes --------  */

Route::group(['middleware' => 'auth'], function () {

    Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');



    /* Paypal routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment.index');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.payment.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.payment.cancel');

    /* Stripe routes */
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment.index');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.payment.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.payment.cancel');

});


require __DIR__ . '/auth.php';
