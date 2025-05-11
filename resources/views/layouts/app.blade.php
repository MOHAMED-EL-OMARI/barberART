<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Website Logo" />
            <h1>BarberART</h1>
        </div>

        <div class="auth-buttons">
            @guest
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endguest
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button>logout</button>
                </form>
            @endauth
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
