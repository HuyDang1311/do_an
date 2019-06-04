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

Route::namespace('Webs\Drivers')->prefix('drivers')->group(function () {
    Route::get('/index', 'ListController')->name('web.driver.list');
    Route::get('/show/{id}', 'ShowController')->name('web.driver.show');
    Route::get('/edit/{id}', 'EditController@show')->name('web.driver.show_edit');
    Route::post('/edit/{id}', 'EditController@update')->name('web.driver.edit');
    Route::get('/create', 'CreateController@show')->name('web.driver.show_create');
    Route::post('/create', 'CreateController@create')->name('web.driver.create');
    Route::post('/delete/{id}', 'DeleteController')->name('web.driver.delete');
});
