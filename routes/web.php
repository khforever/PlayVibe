<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




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
