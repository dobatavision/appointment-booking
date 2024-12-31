@extends('layouts.app')

@section('content')
    <h1>Edit Appointment</h1>
    <form method="POST" action="{{ route('appointments.update', $appointment) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $appointment->client_id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="appointment_time">Appointment Time</label>
            <input type="datetime-local" name="appointment_time" id="appointment_time" class="form-control" onclick="this.showPicker()" value="{{ $appointment->appointment_time->format('Y-m-d\TH:i') }}">
        </div>
        <div class="form-group">
            <label for="notification_method">Notification Method</label>
            <select name="notification_method" id="notification_method" class="form-control">
                <option value="SMS" {{ $appointment->notification_method == 'SMS' ? 'selected' : '' }}>SMS</option>
                <option value="Email" {{ $appointment->notification_method == 'Email' ? 'selected' : '' }}>Email</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $appointment->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <script>
        document.getElementById('appointment_time').addEventListener('focus', function() {
            this.showPicker();
        });
    </script>
@endsection
