@extends('layouts.app')

@section('content')
    <h1>Appointment Details</h1>
    <p>Client: {{ $appointment->client->name }}</p>
    <p>Appointment Time: {{ $appointment->appointment_time }}</p>
    <p>Notification Method: {{ $appointment->notification_method }}</p>
    <p>Description: {{ $appointment->description }}</p>
    <h2>Upcoming Appointments for {{ $appointment->client->name }}</h2>
    <ul>
        @foreach($upcomingAppointments as $upcomingAppointment)
            <li>{{ $upcomingAppointment->appointment_time }}</li>
        @endforeach
    </ul>
@endsection
