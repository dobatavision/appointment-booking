<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Appointment Booking</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointments.index') }}">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">Clients</a>
                </li>
            </ul>
            <div id="clock" class="text-center text-black mr-3"></div>
            <button id="showAppointments" class="btn btn-primary">Notify Upcoming Appointments</button>
        </div>
    </nav>
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <div id="appointmentsPopup" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Future Appointments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="appointmentsList"></ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            const formattedTime = now.toLocaleDateString('en-US', options);
            document.getElementById('clock').innerText = formattedTime;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display the clock immediately

        $(document).ready(function() {
            $('#showAppointments').click(function() {
                console.log('Clicked');
                $.ajax({
                    url: "{{ route('appointments.future') }}",
                    method: 'GET',
                    success: function(data) {
                        $('#appointmentsList').empty();
                        data.forEach(function(appointment) {
                            $('#appointmentsList').append('<li>' + appointment.client.name + ' - ' + appointment.appointment_time + '</li>');
                        });
                        $('#appointmentsPopup').modal('show');
                        setTimeout(function() {
                            $('#appointmentsPopup').modal('hide');
                        }, 10000);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching future appointments:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
