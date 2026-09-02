<?php


use App\Http\Controllers\Admin\{AmenityController,
    CategoryController,
    ListingController,
    ListingImageGalleryController,
    ListingScheduleController,
    ListingVideoController,
    LocationController,
    HeroController,
    PackageController,
    PackageFeatureController,
    PaymentSettingController,
    PendingListingController,
    ProfileController,
    DashboardController,
    PasswordController,
    SettingController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;

/* --------------------- public Routes --------------------- */

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'guest'
    ],
    function () {

        /* ------- Login Route ------- */
        Route::get('/login', [AdminAuthController::class, 'LoginForm'])->name('show.login');


        /* ------- forget-password Route ------- */
        Route::get('forget-password', [AdminAuthController::class, 'passwordRequest'])->name('password.request');
    }
);


/* --------------------- Protected Routes --------------------- */
Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'user.type:admin']
    ],
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

        /*  Listings Routes */

        Route::resource('listings', ListingController::class);

        /* Pending Listings Routes */
        Route::get('listing/pending', [PendingListingController::class, 'index'])->name('listings.pending.index');
        Route::post('listing/pending', [PendingListingController::class, 'updateStatus'])->name('listings.update-status');


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


        /* Listing schedule Routes */
        Route::prefix('listings/{listing}/schedules')
            ->name('listings.schedules.')
            ->controller(ListingScheduleController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{schedule}/edit', 'edit')->name('edit');
                Route::put('/{schedule}', 'update')->name('update');
                Route::delete('/{schedule}', 'destroy')->name('destroy');
            });

        /* Package & PackagesFeatures Routes */
        Route::get('packages/{package}/features', [PackageFeatureController::class, 'packageFeatures'])
            ->name('packages.features');

        Route::get('packages/{package}/features/create', [PackageFeatureController::class, 'createForPackage'])
            ->name('packages.features.create');

        Route::resource('packages', PackageController::class);
        Route::resource('package-features', PackageFeatureController::class);

        /* Settings Routes */
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('general-settings', [SettingController::class, 'update'])->name('general-settings.update');

        /* PayPal Settings Routes */
        Route::get('paypal-settings', [PaymentSettingController::class, 'index'])
            ->name('paypal-settings.index');

        Route::post('payment-settings', [PaymentSettingController::class, 'paypalSetting'])
            ->name('payment-settings.update');

        /* Stripe Settings Routes */
        Route::post('stripe-settings', [PaymentSettingController::class, 'stripeSetting'])
            ->name('stripe-settings.update');

    }
);
