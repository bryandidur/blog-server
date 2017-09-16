<?php

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'JWTAuth'], function () {
    Route::post('', 'AuthenticationController@authenticate');
    Route::put('', 'AuthenticationController@refreshToken');
    Route::delete('', 'AuthenticationController@unAuthenticate');

    Route::post('reset', 'ForgotPasswordController@sendResetLinkEmail');
    Route::put('reset', 'ResetPasswordController@reset');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['jwt.auth', 'jwt.refresh', 'always.json']], function () {

    // Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'UserController@index');
        Route::post('', 'UserController@store');

        Route::get('/{id}', 'UserController@show');
        Route::put('/{id}', 'UserController@update');

        Route::delete('/{id}', 'UserController@destroy');
    });

    // Tags
    Route::group(['prefix' => 'tags'], function () {
        Route::get('', 'TagController@index');
        Route::post('', 'TagController@store');

        Route::get('/{id}', 'TagController@show');
        Route::put('/{id}', 'TagController@update');

        Route::delete('/{id}', 'TagController@destroy');
    });

    // Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('', 'CategoryController@index');
        Route::post('', 'CategoryController@store');

        Route::get('/{id}', 'CategoryController@show');
        Route::put('/{id}', 'CategoryController@update');

        Route::delete('/{id}', 'CategoryController@destroy');
    });

    // Articles
    Route::group(['prefix' => 'articles'], function () {
        Route::get('', 'ArticleController@index');
        Route::post('', 'ArticleController@store');

        Route::get('/{id}', 'ArticleController@show');
        Route::put('/{id}', 'ArticleController@update');

        Route::delete('/{id}', 'ArticleController@destroy');
    });

    // Files
    Route::group(['prefix' => 'files'], function () {
        Route::get('', 'FileController@index');
        Route::post('', 'FileController@store')->name('files.store');

        Route::get('/{id}', 'FileController@show');
        Route::put('/{id}', 'FileController@update')->name('files.update');

        Route::delete('/{id}', 'FileController@destroy');
        Route::delete('', 'FileController@bulkDestroy')->name('files.bulkDestroy');
    });
});
