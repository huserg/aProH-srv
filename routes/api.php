<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// "/api/devices/status" // to query status for device
Route::post('/devices/data', [\App\Http\Controllers\Api\Devices\StatusController::class, 'get_status'])
    ->name('api.devices.status.get');
// "/api/devices/status/update" // to update status of device
Route::post('/devices/data/update', [\App\Http\Controllers\Api\Devices\StatusController::class, 'update_status'])
    ->name('api.devices.status.update');
