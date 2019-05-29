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
        Route::post('/users/{user}/status', 'UserController@updateStatus')->name('user.status');
        Route::delete('/users/{user}/delete', 'UserController@destroy')->name('user.delete');

        /**
         * User settings routes
         */
        Route::post('/settings/language', 'UserSettingController@updateLanguage')->name('user.settings.language.update');

        /**
         * Lesson routes
         */
        Route::get('/lessons', 'LessonController@index')->name('lesson.index');

        /**
         * Document routes
         */
        Route::get('/documents', 'DocumentController@index')->name('document.index');
        Route::get('/documents/create', 'DocumentController@create')->name('document.create');
        Route::post('/documents/create', 'DocumentController@store')->name('document.store');

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
