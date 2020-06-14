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

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', 'Auth\LoginController@getLogin')->name('get_login');
    Route::post('login', 'Auth\LoginController@postLogin')->name('post_login');
    Route::post('logout', 'Auth\LoginController@logout')->name('post_logout');

    Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function() {
    	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    });
});