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
Route::namespace('Apis\Plans')->prefix('plans')->group(function () {
    Route::get('', 'ListPlanController')->name('plan.list');
    Route::get('/{id}', 'ShowPlanController')->name('plan.show');
});
