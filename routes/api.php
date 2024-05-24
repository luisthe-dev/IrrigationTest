<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('zone')->group(function () {
    Route::get('', [ZoneController::class, 'getAllZones']);
    Route::get('{zone}', [ZoneController::class, 'getSingleZone']);
    Route::post('', [ZoneController::class, 'createZone']);
    Route::patch('{zone}', [ZoneController::class, 'updateZone']);
    Route::delete('{zone}', [ZoneController::class, 'deleteZone']);
});

Route::prefix('schedule')->group(function () {
    Route::get('', [ScheduleController::class, 'getAllSchedules']);
    Route::get('{schedule}', [ScheduleController::class, 'getSingleSchedule']);
    Route::post('', [ScheduleController::class, 'createSchedule']);
    Route::put('{schedule}/start', [ScheduleController::class, 'startSchedule']);
    Route::put('{schedule}/stop', [ScheduleController::class, 'stopSchedule']);
    Route::patch('{schedule}', [ScheduleController::class, 'updateSchedule']);
    Route::delete('{schedule}', [ScheduleController::class, 'deleteSchedule']);
});
