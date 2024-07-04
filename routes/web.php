<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Device\DeviceController::class, 'show'])->name('dashboard');

    Route::post('/device/store', [\App\Http\Controllers\Device\DeviceController::class, 'store'])->name('device.store');
    Route::post('/device/connect', [\App\Http\Controllers\Device\DeviceController::class, 'connect'])->name('device.connect');
    Route::post('/device/disconnect', [\App\Http\Controllers\Device\DeviceController::class, 'disconnect'])->name('device.disconnect');
});
