<?php

/**
 * Dashboard Routes
 */
Route::get('/', 'DashboardController@index')->name('dashboard.index');

/**
 * User Routes
 */
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::post('users/{user}/update', 'UserController@update')->name('users.update');