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

Route::group(['namespace' => 'Apis.Customer'], function () {
    Route::post('logout', 'CreateCustomerController@handle')->name('customer.create');

    Route::group(['middleware' => 'auth:api'], function () {
    });
});
