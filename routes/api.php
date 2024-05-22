<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('zone')->group(function () {
    Route::get('', [ZoneController::class, 'getAllZones']);
    Route::get('{zone}', [ZoneController::class, 'getSingleZone']);
    Route::post('', [ZoneController::class, 'createZone']);
    Route::delete('{zone}', [ZoneController::class, 'deleteZone']);
});

Route::prefix('schedule')->group(function () {
    Route::get('', [ScheduleController::class, 'getAllSchedules']);
    Route::get('{schedule}', [ScheduleController::class, 'getSingleSchedule']);
    Route::post('', [ScheduleController::class, 'createSchedule']);
    Route::delete('{schedule}', [ScheduleController::class, 'deleteSchedule']);
});
