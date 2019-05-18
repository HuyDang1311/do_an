<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Apis\CustomerAuth')->group(function () {
    Route::post('login', 'LoginController')->name('customer-auth.login');
    Route::group(['middleware' => 'customer-auth:api'], function () {
        Route::get('info', 'InfoController')->name('customer-auth.info');;
        Route::post('logout', 'LogoutController')->name('customer-auth.logout');;
    });
});
