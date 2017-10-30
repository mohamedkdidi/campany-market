<?php

Route::get('/', function () {
    return view('app');
});

Route::group(['prefix' => 'api/'], function() {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('stock', 'StockController');
    Route::resource('companie', 'CompanieController');
    Route::resource('profile', 'ProfileController');
});