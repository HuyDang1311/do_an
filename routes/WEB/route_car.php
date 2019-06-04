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

Route::namespace('Webs\Cars')->prefix('cars')->group(function () {
    Route::get('/index', 'ListController')->name('web.car.list');
    Route::get('/show/{id}', 'ShowController')->name('web.car.show');
    Route::get('/edit/{id}', 'EditController@show')->name('web.car.show_edit');
    Route::post('/edit/{id}', 'EditController@update')->name('web.car.edit');
    Route::get('/create', 'CreateController@show')->name('web.car.show_create');
    Route::post('/create', 'CreateController@create')->name('web.car.create');
    Route::post('/delete/{id}', 'DeleteController')->name('web.car.delete');
});
