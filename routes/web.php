<?php

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
*/

// Home
Route::get('/', 'HomeController@index')->name('home.index');

// Tags
Route::get('/tag/{slug}', 'TagController@show')->name('tags.show');

// Categories
Route::get('/category/{slug}', 'CategoryController@show')->name('categories.show');

// Articles
Route::get('/article/{slug}', 'ArticleController@show')->name('articles.show');
