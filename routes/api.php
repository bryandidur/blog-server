<?php

Route::group(['prefix' => 'v1', 'middleware' => 'always.json'], function () {

    // Authentication
    Route::group(['prefix' => 'auth', 'namespace' => 'JWTAuth'], function () {
        Route::post('', 'AuthenticationController@authenticate');
        Route::put('', 'AuthenticationController@refreshToken');
        Route::delete('', 'AuthenticationController@unAuthenticate');

        Route::post('reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::put('reset', 'ResetPasswordController@reset');
    });

    // JWT Middleware
    Route::group(['middleware' => 'jwt.auth'], function () {

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
    });
});

