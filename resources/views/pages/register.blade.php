@extends('layouts.app')

@section('content')
    <h2>Register</h2>

    <form action="/register" method="POST">
        @csrf

        <div>
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>
@endsection
