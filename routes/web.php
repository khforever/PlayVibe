<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

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


//////////////////////////////////////dashboard auth///////////////////////////////////////////////

// Route::get('register', function () {
//     return view('dashboard.auth.register');
// });


// Route::get('login', function () {
//     return view('dashboard.auth.login');
// });

// Route::get('recover', function () {
//     return view('dashboard.auth.recoverPassword');

// });



// ////////////////////////////////////////users/////////////////////////////////////////////


// //show all users
// Route::get('users', function () {
//     return view('dashboard.users');
// });




// //add new user
// Route::get('addUser', function () {
//     return view('dashboard.addUser');
// });







// //edit user
// Route::get('editUser', function () {
//     return view('dashboard.editUser');
// });










// ////////////////////////////////////////categories/////////////////////////////////////////////


Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{category_id}', 'edit')->name('edit');
    Route::put('/update/{category_id}', 'update')->name('update');
    Route::delete('/delete/{category_id}', 'destroy')->name('destroy');

});



// /////////////////////////////////////////subcategories////////////////////////////////////////////


// //show all subcategories
// Route::get('subCategories', function () {
//     return view('dashboard.subCategories');
// });

// //add new category  addSubCategory
// Route::get('addSubCategory', function () {
//     return view('dashboard.addSubCategory');
// });



// // edit subcategory
// Route::get('editSubCategory', function (){
//     return view('dashboard.editSubCategory');
// });


// ///////////////////////////////////////products//////////////////////////////////////////////
// //show all products
// Route::get('products', function () {
//     return view('dashboard.products');
// });

// //add new product
// Route::get('addProduct', function () {
//     return view('dashboard.addProduct');
// });


// // edit product
// Route::get('editProduct', function () {
//     return view('dashboard.editProduct');
// });



// /////////////////////////////////////////just test////////////////////////////////////////////

// Route::get('test', function () {
//     return view('dashboard.welcome');
// });

// Route::get('form', function () {
//     return view('dashboard.form');
// });

// Route::get('table', function () {
//     return view('dashboard.table');
// });

// /////////////////////////////////////////////////////////////////////////////////////




// //add new attributes
// Route::get('addAttribute', function () {
//     return view('dashboard.addAttribute');
// });





// //add new review
// Route::get('addReview', function () {
//     return view('dashboard.addReview');
// });



require __DIR__.'/auth.php';
