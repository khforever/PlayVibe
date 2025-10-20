<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
