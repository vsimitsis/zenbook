<?php

/*
|--------------------------------------------------------------------------
| App home Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the home page of the app
|
*/

Route::get('/', 'HomeController@index')->name('home.home');

