@extends('layouts.app')

@section('content')
    <style>
        .register-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .role-selection {
            margin: 15px 0;
        }

        .role-selection label {
            display: inline;
            margin-right: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-list {
            background-color: #ffebee;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
        }

        .error-item {
            color: #d32f2f;
            margin: 5px 0;
        }
    </style>

    <div class="register-container">
        <h2>Register</h2>

        <form action="/register" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-group role-selection">
                <label>Choose Role</label><br>
                <input type="radio" id="barber" name="role" value="barber" required>
                <label for="barber">Barber</label>

                <input type="radio" id="client" name="role" value="client" required>
                <label for="client">Client</label>
            </div>

            <button type="submit">Register</button>

            @if ($errors->any())
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li class="error-item">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
@endsection
