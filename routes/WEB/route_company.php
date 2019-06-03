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

Route::namespace('Webs\Companies')->prefix('companies')->group(function () {
    Route::get('/index', 'ListController')->name('web.company.list');
    Route::get('/show/{id}', 'ShowController')->name('web.company.show');
    Route::get('/edit/{id}', 'EditController@show')->name('web.company.show_edit');
    Route::post('/edit/{id}', 'EditController@update')->name('web.company.edit');
    Route::get('/create', 'CreateController@show')->name('web.company.show_create');
    Route::post('/create', 'CreateController@create')->name('web.company.create');
    Route::post('/delete/{id}', 'DeleteController')->name('web.company.delete');
});
