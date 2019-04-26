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

Route::namespace('Apis\Auth')->prefix('auth')->group(function () {
    Route::post('login', 'UserLoginController')->name('auth.login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('info', 'UserInfoController')->name('auth.info');;
        Route::post('logout', 'UserLogoutController')->name('auth.logout');;
    });
});
