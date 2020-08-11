<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'home');
Route::get('/home', 'PostController@index')->name('post.index');
Route::get('/show/{id}', 'PostController@show')->name('post.show');
Route::post('/search', 'PostController@search')->name('post.search');
Route::get('/user/{id}', 'UserController@index')->name('user.index');

Route::get('login/twitter', 'Auth\LoginController@redirectToProvider')->name('auth.twitterLogin');
Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/create', 'PostController@store')->name('post.store');
    Route::post('/update/{id}', 'PostController@update')->name('post.update');
    Route::get('/update/{id}', 'PostController@edit')->name('post.edit');
    Route::get('/delete/{id}', 'PostController@destroy')->name('post.destroy');
    Route::post('/user/edit/{id}', 'UserController@update')->name('user.update');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
});
Auth::routes();