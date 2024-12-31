@extends('layouts.app')

@section('content')
    <h1>Clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-success">Add New Client</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>EGN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->egn }}</td>
                    <td>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clients->links() }}
@endsection
