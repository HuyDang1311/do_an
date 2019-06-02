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
Route::namespace('Apis\Drivers')->prefix('drivers')->group(function () {
    Route::get('/plan', 'ListPlanController')->name('driver.list_plan');
    Route::get('/{driverId}/plan/{planId}', 'ShowPlanController')->name('driver.show_plan');
});
