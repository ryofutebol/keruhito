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

Route::get('/', 'PostController@index')->name('post.index');
Route::get('/show/{id}', 'PostController@show')->name('post.show');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/create', 'PostController@store')->name('post.store');
    Route::get('/update/{id}', 'PostController@edit')->name('post.edit');
    Route::post('/update/{id}', 'PostController@update')->name('post.update');
    Route::get('/delete', 'PostController@destroy')->name('post.destroy');
});
Auth::routes();