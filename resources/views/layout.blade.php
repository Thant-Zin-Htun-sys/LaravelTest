<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Rating System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('movies.index') }}">🎬 Movie App</a>

        <div class="ml-auto">
            @auth
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm me-2">Recommendations</a>
                <span class="me-2">Welcome, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
                <!-- Add the 'Create Movie' button here -->
                <a href="{{ route('movies.create') }}" class="btn btn-outline-success btn-sm">Create Movie</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Register</a>
            @endauth
        </div>
    </div>
</nav>




    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
