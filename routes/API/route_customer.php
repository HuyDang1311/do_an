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

Route::namespace('Apis\Customers')->prefix('customers')->group(function () {
    Route::get('/{customerId}', 'ShowController')->name('customer.show');
    Route::get('', 'ListController')->name('customer.index');
    Route::post('', 'CreateController')->name('customer.create');
    Route::put('/{id}', 'UpdateController')->name('customer.update');

    Route::group(['middleware' => 'auth:api'], function () {
    });
});
