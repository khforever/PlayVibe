<?php

use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\front\AuthController;
use App\Http\Controllers\Api\front\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\front\ProfileController;
use App\Http\Controllers\Api\SiteReviewController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('register','register');
    Route::post('login','login');
    Route::post('sendotp','sendotp');
    Route::post('verify-email','verifyEmailOtp');
    Route::post('reset-password','resetpassword');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout');
    });

});



// Route::middleware(['auth:sanctum'])->group(function () {
    //categories

Route::apiResource('categories',CategoryController::class)->except('update','destroy');
Route::post('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

//subcategories
     Route::prefix('subcategories')->controller(SubCategoryController::class)->group(function () {

        Route::get('/category/{id}', 'index');
        Route::get('/{id}', 'show');

    });
    // sizes
    Route::apiResource('sizes',SizeController::class);
    //colors
    Route::apiResource('colors',ColorController::class);


    //users
//Route::apiResource('users', UserController::class);
// Route::post('users/{id}/restore', [UserController::class, 'restore']);

//attribute
Route::prefix('attributes')->controller(AttributeController::class)->group(function () {
    Route::post('/', 'store');
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});


//cart controller
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'addItems']);
    Route::put('/cart/item/{id}', [CartController::class, 'updateItem']);
    Route::delete('/cart/item/{id}', [CartController::class, 'removeItem']);

    //review
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ReviewController::class, 'update']);
 Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);


//siteReview
Route::post('/site-reviews', [SiteReviewController::class, 'store']);
Route::get('/my-site-review', [SiteReviewController::class, 'show']);
Route::put('/site-reviews/{id}', [SiteReviewController::class, 'update']);
Route::delete('/site-reviews/{id}', [SiteReviewController::class, 'destroy']);
});




//Product Controller
Route::apiResource('products', ProductController::class);
Route::delete('products/image/{id}', [ProductController::class, 'deleteImage']);

//search
Route::get('/search', [SearchController::class, 'search']);

//order controller

Route::middleware('auth:sanctum')->group(function () {

    Route::post('orders/store', [OrderController::class, 'createOrder']);
    Route::get('/orders/{id}', [OrderController::class, 'showOrder']);
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/profile', [ProfileController::class, 'updateprofile']);
     Route::post('/changepassword', [ProfileController::class, 'changePassword']);
});


//  all site review
Route::get('/site-reviews', [SiteReviewController::class, 'index']);



//favourite controller
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/favourites', [FavouriteController::class, 'index']);
    Route::post('/favourites', [FavouriteController::class, 'store']);
    Route::get('/favourites/{product_id}', [FavouriteController::class, 'show']);
    Route::put('/favourites/{id}', [FavouriteController::class, 'update']);
    Route::delete('/favourites/{product_id}', [FavouriteController::class, 'destroy']);

});
