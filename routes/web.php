<?php

/**
 * Console routes
 */
Route::group(['domain' => 'console.' . config('app.domain')], function() {
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
        Route::delete('/users/{user}/delete', 'UserController@destroy')->name('user.destroy');

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
        Route::post('/documents/store', 'DocumentController@store')->name('document.store');
        Route::get('/document/{document}/download', 'DocumentController@download')->name('document.download');
        Route::get('/document/{document}', 'DocumentController@show')->name('document.show');
        Route::get('/documents/{document}/edit', 'DocumentController@edit')->name('document.edit');
        Route::put('/documents/{document}', 'DocumentController@update')->name('document.update');
        Route::delete('documents/{document}', 'DocumentController@destroy')->name('document.destroy');

        /**
         * Exam routes
         */
        Route::get('/exams', 'ExamController@index')->name('exam.index');
        Route::get('/exams/create', 'ExamController@create')->name('exam.create');
        Route::post('/exams/store', 'ExamController@store')->name('exam.store');
        Route::get('/exams/{exam}', 'ExamController@show')->name('exam.show');
        Route::get('/exams/{exam}/edit', 'ExamController@edit')->name('exam.edit');
        Route::put('/exams/{exam}', 'ExamController@update')->name('exam.update');
        Route::delete('exams/{exam}', 'ExamController@destroy')->name('exam.destroy');

        /**
         * Section routes
         */
        Route::get('/{parent_type}/{parent_id}/sections/create', 'SectionController@create')
            ->where('parent_type', 'exams|lessons')->name('section.create');
        Route::get('/{parent_type}/{parent_id}/sections/{section}', 'SectionController@show')
            ->where('parent_type', 'exams|lessons')->name('section.show');
        Route::post('/{parent_type}/{parent_id}/sections/sections/store', 'SectionController@store')
            ->where('parent_type', 'exams|lessons')->name('section.store');
        Route::get('{parent_type}/{parent_id}/sections/{section}/edit', 'SectionController@edit')
            ->where('parent_type', 'exams|lessons')->name('section.edit');
        Route::put('{parent_type}/{parent_id}/sections/{section}/update', 'SectionController@update')
            ->where('parent_type', 'exams|lessons')->name('section.update');
        Route::delete('/sections/{section}', 'SectionController@destroy')->name('section.destroy');

        /**
         * Module routes
         */
        Route::get('{parent_type}/{parent_id}/sections/{section}/modules/create', 'ModuleController@create')
            ->where('parent_type', 'exams|lessons')->name('module.create');
        Route::post('/sections/{section}/modules/store', 'ModuleController@store')->name('module.store');

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
