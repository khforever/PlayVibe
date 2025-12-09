<?php

use App\Http\Controllers\{
    AttributeController,
    CartController,
    CategoryController,
    ColorController,
    OrderController,
    ProductController,
    ProductVariantController,
    ProfileController,
    ReviewController,
    SizeController,
    SubCategoryController,
    UserController,
    SiteReviewController,
    DashboardController
};

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// --------------------------------------
//      Auth + Verified Middleware
// --------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {
// dashboard
    Route::get('/', DashboardController::class)->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories
    Route::controller(CategoryController::class)
        ->prefix('categories')->name('categories.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{category_id}', 'edit')->name('edit');
            Route::put('/update/{category_id}', 'update')->name('update');
            Route::delete('/delete/{category_id}', 'destroy')->name('destroy');
        });

    // Colors
    Route::controller(ColorController::class)
        ->prefix('colors')->name('colors.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::delete('/destroy/{color_id}', 'destroy')->name('destroy');
        });

    // Reviews (comments)
    Route::controller(ReviewController::class)
        ->prefix('comments')->name('comments.')
        ->group(function () {
            Route::get('/{id}', 'index')->name('index');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

    // Sizes
    Route::controller(SizeController::class)
        ->prefix('sizes')->name('sizes.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::delete('/destroy/{size_id}', 'destroy')->name('destroy');
        });

    // Products
    Route::controller(ProductController::class)
        ->prefix('products')->name('products.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/show/{product_id}', 'show')->name('show');
            Route::get('/edit/{product_id}', 'edit')->name('edit');
            Route::put('/update/{product_id}', 'update')->name('update');
            Route::delete('/destroy/{product_id}', 'destroy')->name('destroy');
            Route::delete('/image/{id}', 'deleteImage')->name('deleteImage');
        });

    // Product Variants
    Route::controller(ProductVariantController::class)
        ->prefix('productVariants')->name('productVariants.')
        ->group(function () {
            Route::get('/{product_id}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::delete('/destroy/{variant_id}', 'destroy')->name('destroy');
        });

    // Cart
    Route::controller(CartController::class)
        ->prefix('cart')->name('cart.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    // Orders
    Route::controller(OrderController::class)
        ->prefix('orders')->name('orders.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/deliverd/{id}', 'deliverd')->name('deliverd');
        });

    // Site Reviews
    Route::controller(SiteReviewController::class)
        ->prefix('site-reviews')->name('site-reviews.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/approve/{id}', 'approve')->name('approve');
        });

    // Users
    Route::controller(UserController::class)
        ->prefix('users')->name('users.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::post('/restore/{id}', 'restore')->name('restore');
        });

    // Subcategories
    Route::group([
        'prefix' => 'subcategories',
        'as' => 'subcategory.',
        'controller' => SubCategoryController::class,
    ], function () {
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('index', 'index')->name('index');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'destroy')->name('delete');
    });

    // Attributes
    Route::group([
        'prefix' => 'attributes',
        'as' => 'attributes.',
        'controller' => AttributeController::class,
    ], function () {
        Route::get('create/{id}', 'create')->name('create');
        Route::post('store/{id}', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
    });

// read all notification
    Route::post('/admin/notifications/read-all', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('admin.notifications.read-all');

});

require __DIR__ . '/auth.php';
