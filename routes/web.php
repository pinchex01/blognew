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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post', 'PostController@post')->name('post');
Route::get('/category', 'CategoryController@category')->name('category');
Route::get('/profile', 'ProfileController@profile')->name('profile');

Route::post('/addCategory', 'CategoryController@addCategory');
Route::get('/category/{post}' , 'PostController@category')->name('categories.view');
Route::post('/addProfile', 'ProfileController@addProfile');
Route::post('/addPost' , 'PostController@addPost');

Route::get('/view/{post}' , 'PostController@view')->name('posts.view');
Route::get('/edit/{post}' , 'PostController@edit')->name('posts.edit');
Route::post('editPost/{post}' , 'PostController@editPost')->name('posts.edit');
Route::get('/delete/{id}' , 'PostController@deletePost')->name('posts.delete');
Route::get('/like/{post}' , 'PostController@like')->name('posts.like');
Route::get('/dislike/{post}' , 'PostController@dislike')->name('posts.dislike');


