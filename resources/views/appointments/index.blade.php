@extends('layouts.app')

@section('content')
    <h1>Appointments</h1>
    <form method="GET" action="{{ route('appointments.index') }}">
        <input type="date" name="date_from" value="{{ request('date_from') }}">
        <input type="date" name="date_to" value="{{ request('date_to') }}">
        <input type="text" name="egn" placeholder="EGN" value="{{ request('egn') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <a href="{{ route('appointments.create') }}" class="btn btn-success mt-3">Add New Appointment</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Client</th>
                <th>EGN</th>
                <th>Appointment Time</th>
                <th>Notification Method</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->client->name }}</td>
                    <td>{{ $appointment->client->egn }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ $appointment->notification_method }}</td>
                    <td>{{ $appointment->description }}</td>
                    <td>
                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-info">View</a>
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $appointments->links() }}
@endsection
