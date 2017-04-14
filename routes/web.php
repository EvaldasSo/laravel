<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/feed', 'PostsController@feed')->name('posts.feed');
Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update']]);
Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');
