<?php

Auth::routes();

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/feed', 'PostsController@feed')->name('posts.feed');
Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update']]);
Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

Route::get('feed', 'FeedController@index')->name('feed');
Route::resource('feed', 'FeedController', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
Route::delete('/feed/{feed}', 'FeedController@destroy')->name('feed.destroy');
Route::get('/feed/categories/{category}', 'FeedController@indexByCategory');


//Route::get('/feed/category/{id}', 'CategoryController@index');
Route::get('category', 'CategoryController@index')->name('category');
Route::resource('category', 'CategoryController', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
Route::delete('/category/{category}', 'CategoryController@destroy')->name('category.destroy');
