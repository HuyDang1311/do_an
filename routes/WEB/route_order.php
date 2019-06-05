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

Route::namespace('Webs\Orders')->prefix('orders')->group(function () {
    Route::get('/index', 'ListController')->name('web.order.list');
    Route::get('/show/{id}', 'ShowController')->name('web.order.show');
    Route::post('/cancel/{id}', 'CancelController')->name('web.order.cancel');
});
