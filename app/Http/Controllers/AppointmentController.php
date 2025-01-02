<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::with('client')
            ->when($request->date_from, function ($query) use ($request) {
                $query->where('appointment_time', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->where('appointment_time', '<=', $request->date_to);
            })
            ->when($request->egn, function ($query) use ($request) {
                $query->whereHas('client', function ($query) use ($request) {
                    $query->where('egn', $request->egn);
                });
            })
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('appointments.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appointment_time' => 'required|date|after:now',
            'notification_method' => 'required|in:SMS,Email',
        ], [
            'appointment_time.after' => 'The appointment time must be a future date and time.',
        ]);

        $appointment = Appointment::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'You have successfully booked the appointment! The client will be notified via ' . $appointment->notification_method . '.',
            'appointment' => $appointment
        ]);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('client');
        $upcomingAppointments = Appointment::where('client_id', $appointment->client_id)
            ->where('appointment_time', '>', $appointment->appointment_time)
            ->get();

        return view('appointments.show', compact('appointment', 'upcomingAppointments'));
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        return view('appointments.edit', compact('appointment', 'clients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appointment_time' => 'required|date|after:now',
            'notification_method' => 'required|in:SMS,Email',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    public function future()
    {
        $futureAppointments = Appointment::with('client')
            ->get();

        return response()->json($futureAppointments);
    }
}
