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
Route::namespace('Apis\Orders')->prefix('orders')->group(function () {
    Route::get('/payment-methods', 'ListPaymentMethodOrderController')->name('order.payment_methods');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('', 'CreateOrderController')->name('order.create');
        Route::get('', 'HistoryOrderController')->name('order.history');
        Route::get('/{id}', 'ShowOrderController')->name('order.show');
    });
});
