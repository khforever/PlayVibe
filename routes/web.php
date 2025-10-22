<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Route::get('register', function () {
    return view('dashboard.auth.register');
});


Route::get('login', function () {
    return view('dashboard.auth.login');
});

Route::get('recover', function () {
    return view('dashboard.auth.recoverPassword');
});



Route::get('test', function () {
    return view('dashboard.welcome');
});

Route::get('form', function () {
    return view('dashboard.form');
});

Route::get('table', function () {
    return view('dashboard.table');
});



//show allcategories
Route::get('categories', function () {
    return view('dashboard.categories');
});


//show all subcategories
Route::get('subCategories', function () {
    return view('dashboard.subCategories');
});



//show all products
Route::get('products', function () {
    return view('dashboard.products');
});


//add new category  addSubCategory
Route::get('addSubCategory', function () {
    return view('dashboard.addSubCategory');
});
//add new user
Route::get('addUser', function () {
    return view('dashboard.addUser');
});

//add new attributes
Route::get('addAttribute', function () {
    return view('dashboard.addAttribute');
});


//add new category  addCategory
Route::get('addCategory', function () {
    return view('dashboard.addCategory');
});

//add new product
Route::get('addProduct', function () {
    return view('dashboard.addProduct');
});


//add new review
Route::get('addReview', function () {
    return view('dashboard.addReview');
}); 
