<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AppointmentController;

Route::middleware('auth:sanctum')->group(function () {
    // Route::post('clients', ClientController::class);
    // Route::apiResource('api/appointments', ApiAppointmentController::class);
//     // Route::get('appointments/future', [AppointmentController::class, 'future']);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/data', function () {
//     return response()->json(['data' => 'This is some data']);
// });

