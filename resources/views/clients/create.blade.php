@extends('layouts.app')

@section('content')
    <h1>Add New Client</h1>
    <form method="POST" action="{{ route('clients.store') }}">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <label for="egn">EGN</label>
        <input type="text" name="egn" id="egn" required>
        <button type="submit">Save</button>
    </form>
@endsection
