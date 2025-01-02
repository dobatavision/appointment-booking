<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AppointmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

//Test route
Route::get('data', function () {
    return response()->json(['data' => 'This is some data']);
});

Route::apiResource('api_clients', ClientController::class);
Route::apiResource('api_appointments', AppointmentController::class);


