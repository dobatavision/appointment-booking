<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with('client')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appointment_time' => 'required|date|after:now',
            'notification_method' => 'required|in:SMS,Email',
        ]);

        $appointment = Appointment::create($request->all());

        return response()->json($appointment, 201);
    }

    public function show(Appointment $appointment)
    {
        return $appointment->load('client');
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appointment_time' => 'required|date|after:now',
            'notification_method' => 'required|in:SMS,Email',
        ]);

        $appointment->update($request->all());

        return response()->json($appointment, 200);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json(null, 204);
    }

    public function future()
    {
        $futureAppointments = Appointment::with('client')
            ->where('appointment_time', '>', now())
            ->get();

        return response()->json($futureAppointments);
    }
}
