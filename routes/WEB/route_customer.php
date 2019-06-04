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

Route::namespace('Webs\Customers')->prefix('customers')->group(function () {
    Route::get('/index', 'ListController')->name('web.customers.list');
    Route::get('/show/{id}', 'ShowController')->name('web.customers.show');
    Route::get('/edit/{id}', 'EditController@show')->name('web.customers.show_edit');
    Route::post('/edit/{id}', 'EditController@update')->name('web.customers.edit');
    Route::get('/create', 'CreateController@show')->name('web.customers.show_create');
    Route::post('/create', 'CreateController@create')->name('web.customers.create');
    Route::post('/delete/{id}', 'DeleteController')->name('web.customers.delete');
});
