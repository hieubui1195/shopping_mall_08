<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.layouts.index');
});
Route::get('/tt', function () {
    return view('user.layouts.checkout');
});
Route::get('/ct', function () {
    return view('user.layouts.product-details');
});
Route::get('/ds', function () {
    return view('user.layouts.products');
});

Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('change-language');
Route::get('getImg', 'HomeController@getImg');
