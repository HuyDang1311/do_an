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

Route::namespace('Webs\Plans')->prefix('plans')->group(function () {
    Route::get('/index', 'ListController')->name('web.plans.list');
    Route::get('/show/{id}', 'ShowController')->name('web.plans.show');
    Route::get('/edit/{id}', 'EditController@show')->name('web.plans.show_edit');
    Route::post('/edit/{id}', 'EditController@update')->name('web.plans.edit');
    Route::get('/create', 'CreateController@show')->name('web.plans.show_create');
    Route::post('/create', 'CreateController@create')->name('web.plans.create');
    Route::post('/delete/{id}', 'DeleteController')->name('web.plans.delete');
});
