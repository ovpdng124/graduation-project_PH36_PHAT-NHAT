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

Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'UserController@index')->name('index');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {
        // All routes for admin users
        Route::get('/', 'UserController@index')->name('admin.index');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@show')->name('user.list');
            Route::get('/create', 'UserController@create')->name('user.create-form');
            Route::post('/create', 'UserController@store')->name('user.create');
            Route::get('/edit/{id}', 'UserController@edit')->name('user.edit-form');
            Route::put('/edit/{id}', 'UserController@update')->name('user.edit');
            Route::delete('/delete/{id}', 'UserController@delete')->name('user.delete');
        });
    });

    Route::group(['namespace' => 'User'], function () {

    });
});
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/register', 'RegisterController@showRegisterForm')->name('register-form');
    Route::post('/register', 'RegisterController@store')->name('register');
    Route::get('/verify-notification', 'RegisterController@verifyNotification')->name('verify-notification');
    Route::get('/verify', 'RegisterController@verify')->name('verify');
});
