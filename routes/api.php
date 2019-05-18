<?php

use Illuminate\Http\Request;

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
Route::get('version', function () {
    return "v1.0.0";
});

Route::group(['middleware' => 'api'], function () {
    require __DIR__ . '/API/route_auth.php';
    require __DIR__ . '/API/route_customer_auth.php';
    require __DIR__ . '/API/route_customer.php';
    require __DIR__ . '/API/route_bus_station.php';
    require __DIR__ . '/API/route_plan.php';
    require __DIR__ . '/API/route_order.php';
});
