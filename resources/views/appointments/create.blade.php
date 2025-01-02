@extends('layouts.app')

@section('content')
    <h1>Create Appointment</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form  id="appointmentForm" method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="appointment_time">Appointment Time</label>
            <input type="datetime-local" name="appointment_time" id="appointment_time" class="form-control" onclick="this.showPicker()">
        </div>
        <div class="form-group">
            <label for="notification_method">Notification Method</label>
            <select name="notification_method" id="notification_method" class="form-control">
                <option value="SMS">SMS</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <script>
        document.getElementById('appointment_time').addEventListener('focus', function() {
            this.showPicker();
        });

        $(document).ready(function() {
        $('#appointmentForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('appointments.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        // Optionally, you can reset the form or update the UI
                        $('#appointmentForm')[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error booking appointment:', error);
                    toastr.error('An error occurred while booking the appointment.');
                }
            });
        });
    });
    </script>
@endsection
