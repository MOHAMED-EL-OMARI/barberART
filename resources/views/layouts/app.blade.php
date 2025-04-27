<html>

<head>
    <title>My Website</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Website Logo" />
        </div>
    
        <div class="auth-buttons">
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>My Footer</p>
    </footer>

</body>

</html>
