<?php

/**
 * Console routes
 */
Route::group(array('domain' => 'console.' . config('app.domain')), function() {
    Auth::routes(['verify' => true]);

    Route::group(['middleware' => ['auth', 'verified', 'checkUserStatus', 'passViewData']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        /**
         * User routes
         */
        Route::get('/users', 'UserController@index')->name('user.index');
        Route::get('users/create', 'UserController@create')->name('user.create');
        Route::post('users/store', 'UserController@store')->name('user.store');
        Route::get('/users/{user}', 'UserController@show')->name('user.show');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('users/{user}/update', 'UserController@update')->name('user.update');
        Route::post('users/{user}/status', 'UserController@updateStatus')->name('user.status');
        Route::delete('users/{user}/delete', 'UserController@delete')->name('user.delete');

        /**
         * Customer routes
         */
        Route::get('customers', 'CustomerController@index')->name('customer.index');
        Route::get('customers/create', 'CustomerController@create')->name('customer.create');
        Route::post('customers/store', 'CustomerController@store')->name('customer.store');
        Route::get('customers/{customer}', 'CustomerController@show')->name('customer.show');
        Route::get('customers/{customer}/edit', 'CustomerController@edit')->name('customer.edit');
        Route::put('customers/{customer}/update', 'CustomerController@update')->name('customer.update');
        Route::delete('customers/{customer}/delete', 'CustomerController@delete')->name('customer.delete');

        /**
         * Notification routes
         */
        Route::get('/notifications', 'NotificationController@index')->name('notification.index');
    });
});

/**
 * Land page routes
 */
Route::get('/', 'HomeController@index')->name('home');
