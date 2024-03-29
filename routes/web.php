<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'web'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('', 'HomeController@index')->name('home');
    require __DIR__ . '/WEB/route_bus_station.php';
    require __DIR__ . '/WEB/route_company.php';
    require __DIR__ . '/WEB/route_car.php';
    require __DIR__ . '/WEB/route_driver.php';
    require __DIR__ . '/WEB/route_customer.php';
    require __DIR__ . '/WEB/route_plan.php';
    require __DIR__ . '/WEB/route_order.php';
    require __DIR__ . '/WEB/route_user.php';
});
