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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/register', 'RegisterController@showRegisterForm')->name('register-form');
    Route::post('/register', 'RegisterController@store')->name('register');
    Route::get('/verify-notification', 'RegisterController@verifyNotification')->name('verify-notification');
    Route::get('/verify', 'RegisterController@verify')->name('verify');
    Route::get('/sendMail', 'RegisterController@sendMail')->name('send-mail');
    Route::get('/login', 'LoginController@showLoginForm')->name('login-form');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::get('/forgot-password', 'ResetPasswordController@passwordForgot')->name('password-forgot-form');
    Route::post('/forgot-password', 'ResetPasswordController@sendPasswordMail')->name('send-password-mail');
    Route::get('/password-reset', 'ResetPasswordController@passwordResetForm')->name('password-reset-form');
    Route::post('/password-reset', 'ResetPasswordController@passwordReset')->name('password-reset');
});

Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'UserController@index')->name('index');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {
        // All routes for admin users
        Route::get('/', 'UserController@index')->name('admin.index');
        Route::group(['prefix' => 'profile'], function (){
            Route::get('/', 'UserController@profile')->name('admin.profile');
            Route::get('/edit', 'UserController@editProfile')->name('admin.edit.profile-form');
            Route::put('/edit', 'UserController@updateProfile')->name('admin.edit.profile');
            Route::get('/change-password', 'UserController@changePasswordProfile')->name('admin.profile.change-password-form');
            Route::put('/change-password', 'UserController@updatePasswordProfile')->name('admin.profile.change-password');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@show')->name('user.list');
            Route::get('/create', 'UserController@create')->name('user.create-form');
            Route::post('/create', 'UserController@store')->name('user.create');
            Route::get('/edit/{id}', 'UserController@edit')->name('user.edit-form');
            Route::put('/edit/{id}', 'UserController@update')->name('user.edit');
            Route::delete('/delete/{id}', 'UserController@delete')->name('user.delete');
        });

        Route::resource('voucher', 'VoucherController');
        Route::resource('product', 'ProductController');
        Route::resource('product-attribute', 'ProductAttributeController');
        Route::resource('category', 'CategoryController');
    });

    Route::group(['namespace' => 'User'], function () {
        Route::get('/profile', 'UserController@profile')->name('profile');
    });
});
