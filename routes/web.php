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

Route::get('/', 'NewsController@getAllData');
Route::get('/news/{source}', 'NewsController@index');
Route::get('/news/{country}/country', 'NewsController@country');
Route::get('news/{id}/details','NewsController@details');
Auth::routes();
Route::post('news/like','NewsController@like')->name('likeNews');

Route::get('/home', 'HomeController@index')->name('home');
