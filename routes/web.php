<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.users');
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
    Route::get('/edit/{product_id}', 'edit')->name('edit');
    Route::put('/update/{product_id}', 'update')->name('update');
    Route::delete('/destroy/{product_id}', 'destroy')->name('destroy');
});

// ////////////////////////////////////////Product variants  /////////////////////////////////////////////
Route::controller(ProductVariantController::class)->prefix('productVariants')->name('productVariants.')->group(function () {
    Route::get('/{product_id}', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::delete('/destroy/{variant_id}', 'destroy')->name('destroy');

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


require __DIR__.'/auth.php';
