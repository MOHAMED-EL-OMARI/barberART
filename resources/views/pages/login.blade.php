@extends('layouts.app')

@section('content')
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9fafb;
        }

        .login-box {
            max-width: 28rem;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 1.875rem;
            font-weight: 800;
            color: #111827;
        }

        .form-container {
            margin-top: 2rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
        }

        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #4338ca;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #4f46e5;
            text-decoration: none;
        }

        .register-link a:hover {
            color: #4338ca;
        }

        .error-list {
            padding: 1rem;
            background-color: #fee2e2;
            border-radius: 0.375rem;
            margin-top: 1rem;
        }

        .error-item {
            color: #dc2626;
            margin: 0.5rem 0;
        }
    </style>

    <div class="login-container">
        <div class="login-box">
            <div>
                <h2 class="login-title">Sign in to your account</h2>
            </div>
            <form class="form-container" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required class="form-input"
                        placeholder="Email address">
                </div>
                <div class="input-group">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required class="form-input"
                        placeholder="Password">
                </div>

                <div class="remember-forgot">
                    <div class="checkbox-group">
                        <input id="remember_me" name="remember" type="checkbox">
                        <label for="remember_me" style="margin-left: 0.5rem;">Remember me</label>
                    </div>

                    <div>
                        {{-- <a href="{{ route('password.request') }}">Forgot your password?</a> --}}
                    </div>
                </div>

                <div>
                    <button type="submit" class="submit-btn">Sign in</button>
                </div>

                <div class="register-link">
                    <p>Don't have an account?
                        <a href="{{ route('register') }}">Register here</a>
                    </p>
                </div>

                @if ($errors->any())
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li class="error-item">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </form>
        </div>
    </div>
@endsection
