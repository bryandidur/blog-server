<?php

Route::group(['prefix' => 'v1'], function () {

    // Authentication
    Route::group(['prefix' => 'auth'], function () {
        Route::post('', 'JWTAuth\AuthenticationController@authenticate');
        Route::put('', 'JWTAuth\AuthenticationController@refreshToken');
        Route::delete('', 'JWTAuth\AuthenticationController@unAuthenticate');
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
    });
});

