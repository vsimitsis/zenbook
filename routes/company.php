<?php

/**
 * Dashboard Routes
 */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

/**
 * User Routes
 */
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');