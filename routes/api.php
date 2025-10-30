<?php

use App\Http\Controllers\Api\front\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\ColorController;

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


Route::apiResource('categories',CategoryController::class)->except('update','destroy');
Route::post('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);


Route::apiResource('sizes',SizeController::class);
Route::apiResource('colors',ColorController::class);
