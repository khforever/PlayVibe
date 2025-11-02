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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.auth.login');
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
//     return view('dashboard.users.index');
// });




// //add new user
// Route::get('create', function () {
//     return view('dashboard.users.create');
// });







// //edit user
// Route::get('edit', function () {
//     return view('dashboard.users.edit');
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



// Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');

//    Route::post('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');



// Route::controller(UserController::class)
// ->prefix('users')->name('users.')->group(function ()
// {

//      Route::get('/', 'index')->name('index');
//     Route::get('/create', 'create')->name('create');
//      Route::get('/show/{id}', 'show')->name('show');
//     Route::post('/store', 'store')->name('store');
//     Route::get('/edit/{id}', 'edit')->name('edit');
//     Route::put('/update/{id}', 'update')->name('update');
//     Route::delete('/destroy/{id}', 'destroy')->name('destroy');



// });


// 'dashboard.users.trashUsers'

//  Route::resource('users', UserController::class);




// /////////////////////////////////////////subcategories////////////////////////////////////////////


// //show all subcategories
// Route::get('subCategories', function () {
//     return view('dashboard.subCategories');
// });

// //add new category  addSubCategory
//   Route::get('addSubCategory', function () {
//     return view('dashboard.addSubCategory');
//   });



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
//   Route::get('addProduct', function () {
//       return view('dashboard.addProduct');
//   });


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


//add new category  addSubCategory
//  Route::get('addSubCategory', function () {
//     return view('dashboard.addSubCategory');
//  });



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
    'as'=>'attribute.',
    'controller'=>AttributeController::class,
],function(){
    Route::get('create','create')->name('create');
    Route::post('store','store')->name('store');
    Route::get('edit/{id}','edit')->name('edit');
    Route::put('update/{id}','update')->name('update');

 });
 

// //add new user
// Route::get('addUser', function () {
//     return view('dashboard.addUser');
// });

// //add new attributes
// Route::get('addAttribute', function () {
//     return view('dashboard.addAttribute');
// });


// //add new attributes
// Route::get('addAttribute', function () {
//     return view('dashboard.addAttribute');
// });





// //add new review
// Route::get('addReview', function () {
//     return view('dashboard.addReview');
// });



require __DIR__.'/auth.php';
