<?php

use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::prefix('zone')->group(function () {
    Route::get('', [ZoneController::class, 'getAllZones']);
    Route::get('{zone}', [ZoneController::class, 'getSingleZone']);
    Route::post('', [ZoneController::class, 'createZone']);
});
