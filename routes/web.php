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

Route::get('/login', 'AuthController@showLoginForm')->name('login-form');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['namespace' => 'Guest'], function () {
    Route::get('/', 'UserController@index')->name('index');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {
        // All routes for admin users
        Route::get('/', 'UserController@index')->name('admin.index');

    });

    Route::group(['namespace' => 'Guest'], function () {
        // All routes for guest users
    });
});


