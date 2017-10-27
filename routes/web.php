<?php

Route::get('/', function () {
    return view('app');
});

Route::group(['prefix' => 'api/'], function() {
    Route::resource('stock', 'StockController');
    Route::resource('companie', 'CompanieController');
});