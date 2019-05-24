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

Route::namespace('Apis\BusStations')->prefix('bus-stations')->group(function () {
    Route::get('', 'ListBusStationController')->name('bus_station.list');
    Route::get('/{id}', 'ShowBusStationController')->name('bus_station.show');
    Route::post('/{id}', 'CreateBusStationController')->name('bus_station.create');
    Route::put('/{id}', 'UpdateBusStationController')->name('bus_station.update');
    Route::delete('/{id}', 'DeleteBusStationController')->name('bus_station.delete');
});
