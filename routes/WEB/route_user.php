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

Route::namespace('Webs\Users')->prefix('users')->group(function () {
    Route::get('/info', 'ShowController')->name('web.users.show');
    Route::get('/edit', 'EditController@show')->name('web.users.show_edit');
    Route::post('/edit', 'EditController@update')->name('web.users.edit');
});
