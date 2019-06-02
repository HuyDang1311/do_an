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

Route::namespace('Webs\BusStations')->prefix('bus-stations')->group(function () {
    Route::get('index', 'ListBusStationController')->name('web.bus_station.list');
    Route::get('/show/{id}', 'ShowBusStationController')->name('web.bus_station.show');
    Route::get('/edit/{id}', 'EditBusStationController@show')->name('web.bus_station.show_edit');
    Route::post('/edit/{id}', 'EditBusStationController@update')->name('web.bus_station.edit');
    Route::get('/create', 'CreateBusStationController@show')->name('web.bus_station.show_create');
    Route::post('/create', 'CreateBusStationController@create')->name('web.bus_station.create');
    Route::post('/delete/{id}', 'DeleteBusStationController')->name('web.bus_station.delete');
});
