<?php

/**
 * Console routes
 */
Route::group(array('domain' => 'console.' . config('app.domain')), function() {
    Auth::routes();

    Route::group(['middleware' => ['auth', 'checkUserStatus', 'passViewData']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        /**
         * User routes
         */
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('users/create', 'UserController@create')->name('users.create');
        Route::post('users/store', 'UserController@store')->name('users.store');
        Route::get('/users/{user}', 'UserController@show')->name('users.show');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('users/{user}/update', 'UserController@update')->name('users.update');
        Route::post('users/{user}/status', 'UserController@updateStatus')->name('users.status');
        Route::delete('users/{user}/delete', 'UserController@delete')->name('users.delete');
    });
});

/**
 * Land page routes
 */
Route::get('/', 'HomeController@index')->name('home.home');
