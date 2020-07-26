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

Auth::routes();

Route::get('/', 'PostController@index')->name('home');
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/add', 'PostController@store')->name('post.store');
    Route::post('/show{id}', 'PostController@show')->name('post.show');
    Route::get('/update/{id}', 'PostController@edit')->name('post.edit');
    Route::get('/update/{id}', 'PostController@update')->name('post.update');
    Route::get('/delete', 'PostController@destroy')->name('post.destroy');
});