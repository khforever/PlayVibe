<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.users.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';








// ////////////////////////////////////////categories/////////////////////////////////////////////



Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{category_id}', 'edit')->name('edit');
    Route::put('/update/{category_id}', 'update')->name('update');
    Route::delete('/delete/{category_id}', 'destroy')->name('destroy');

});

// ////////////////////////////////////////colors/////////////////////////////////////////////
Route::controller(ColorController::class)->prefix('colors')->name('colors.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::delete('/destroy/{color_id}', 'destroy')->name('destroy');




});
// ////////////////////////////////////////sizes  /////////////////////////////////////////////
Route::controller(SizeController::class)->prefix('sizes')->name('sizes.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::delete('/destroy/{size_id}', 'destroy')->name('destroy');




});

// ////////////////////////////////////////products  /////////////////////////////////////////////
Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/show/{product_id}', 'show')->name('show');
    Route::get('/edit/{product_id}', 'edit')->name('edit');
    Route::put('/update/{product_id}', 'update')->name('update');
    Route::delete('/destroy/{product_id}', 'destroy')->name('destroy');
    Route::delete('/image/{id}', [ProductController::class, 'deleteImage'])->name('deleteImage');
});

// ////////////////////////////////////////Product variants  /////////////////////////////////////////////
Route::controller(ProductVariantController::class)->prefix('productVariants')->name('productVariants.')->group(function () {
    Route::get('/{product_id}', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::delete('/destroy/{variant_id}', 'destroy')->name('destroy');

});

// //////////////////////////////////////////cart  /////////////////////////////////////////////
Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');

});
// //////////////////////////////////////////Order  /////////////////////////////////////////////
Route::controller(OrderController::class)->prefix('orders')->name('orders.')->group(function () {
    Route::get('/', 'index')->name('index');

});








// ////////////////////////////////////////users  /////////////////////////////////////////////

   Route::controller(UserController::class)
        ->prefix('users')
        ->name('users.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/trash', 'trash')->name('trash');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::get('/show/{id}', 'show')->name('show');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::post('/restore/{id}', 'restore')->name('restore');
        });











//subcategories
Route::group([
    'prefix'=>'subcategories',
    'as'=>'subcategory.',
    'controller'=>SubCategoryController::class,
],function(){
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    Route::get('index','index')->name('index');
    Route::get('edit/{id}','edit')->name('edit');
    Route::put('update/{id}','update')->name('update');
    Route::get('delete/{id}','destroy')->name('delete');

 });

Route::group([
    'prefix'=>'attributes',
    'as'=>'attributes.',
    'controller'=>AttributeController::class,
],function(){
    Route::get('create/{id}','create')->name('create');
    Route::post('store/{id}','store')->name('store');
    Route::get('edit/{id}','edit')->name('edit');
    Route::put('update/{id}','update')->name('update');

 });






require __DIR__.'/auth.php';
