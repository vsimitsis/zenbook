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
         * Student routes
         */
        Route::get('students', 'LessonController@index')->name('lesson.index');

        /**
         * Notification routes
         */
        Route::get('/notifications', 'NotificationController@index')->name('notification.index');
    });
});

/**
 * Land page routes
 */
Route::get('/', 'Home\HomeController@index')->name('home');
