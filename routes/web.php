<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NoteController;

Route::get('/', [AppointmentController::class, 'index']);
Route::get('appointments/future', [AppointmentController::class, 'future'])->name('appointments.future');

Route::resource('clients', ClientController::class);
Route::resource('appointments', AppointmentController::class);
// Route::resource('notes', NoteController::class);


