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
    Route::get('/notification', 'RegisterController@showNotification')->name('notification');
    Route::get('/verify', 'RegisterController@verify')->name('verify');
    Route::get('/sendMail', 'RegisterController@sendMailAgain')->name('send-mail-again');
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
    Route::get('product/{id}', 'ProductController@showDetailProduct')->name('product-detail');
    Route::get('list-cart', 'ProductController@showListCart')->name('list.cart');
    Route::get('product-cart', 'ProductController@showProductCart');
    Route::get('shop', 'ProductController@getShoppingProducts')->name('shopping');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {
        // All routes for admin users
        Route::get('/', 'UserController@index')->name('admin.index');
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'UserController@profile')->name('admin.profile');
            Route::get('/change-password', 'UserController@changePasswordProfile')->name('admin.profile.change-password-form');
            Route::put('/change-password', 'UserController@updatePasswordProfile')->name('admin.profile.change-password');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@show')->name('user.list');
            Route::get('/create', 'UserController@create')->name('user.create');
            Route::post('/create', 'UserController@store')->name('user.store');
            Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
            Route::put('/edit/{id}', 'UserController@update')->name('user.update');
            Route::delete('/delete/{id}', 'UserController@delete')->name('user.delete');
            Route::get('/profile/{id}', 'UserController@edit')->name('profile.user.edit');
            Route::put('/profile/{id}', 'UserController@update')->name('profile.user.update');
        });

        Route::resource('voucher', 'VoucherController');
        Route::resource('product', 'ProductController');
        Route::resource('product-attribute', 'ProductAttributeController');
        Route::resource('category', 'CategoryController');

        Route::group(['prefix' => 'category'], function () {
            Route::get('product/create/', 'ProductController@create')->name('category.product.create');
            Route::post('product/create/', 'ProductController@store')->name('category.product.store');
            Route::get('detail/{category}/edit', 'CategoryController@edit')->name('category.detail.edit');
            Route::put('detail/{category}/', 'CategoryController@update')->name('category.detail.update');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('product-attribute/create/', 'ProductAttributeController@create')->name('product.product-attribute.create');
            Route::post('product-attribute/create/', 'ProductAttributeController@store')->name('product.product-attribute.store');
            Route::get('product-attribute/{product_attribute}/edit', 'ProductAttributeController@edit')->name('product.product-attribute.edit');
            Route::put('product-attribute/{product_attribute}/', 'ProductAttributeController@update')->name('product.product-attribute.update');
            Route::get('detail/{product}/edit', 'ProductController@edit')->name('product.detail.edit');
            Route::put('detail/{product}/', 'ProductController@update')->name('product.detail.update');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@showListOrder')->name('order.list');
            Route::get('/detail/{id}', 'OrderController@detail')->name('order.detail');
            Route::put('updateStatus/{id}', 'OrderController@updateStatus')->name('order.updateStatus');
            Route::get('/edit/{id}', 'OrderController@edit')->name('order.edit');
            Route::put('/update/{id}', 'OrderController@update')->name('order.update');
            Route::delete('/delete/{id}', 'OrderController@delete')->name('order.delete');
        });
    });

    Route::group(['namespace' => 'User'], function () {
        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::put('/edit/{id}', 'UserController@update')->name('update');
        Route::get('/change-password', 'UserController@changePasswordUser')->name('edit-password');
        Route::put('/change-password', 'UserController@updatePasswordUser')->name('update-password');
        Route::get('/order', 'OrderController@showOrderPage')->name('order.page');
        Route::post('/create-order', 'OrderController@createOrder')->name('order.create');
        Route::get('/my-order', 'OrderController@showOrderInformation')->name('order.info');
        Route::get('/order-detail/{id}', 'OrderController@showOrderDetail')->name('user.order.detail');
        Route::get('/order-form', 'OrderController@showOrderForm');
        Route::get('/check-voucher', 'OrderController@checkVoucherCode');
    });
});
