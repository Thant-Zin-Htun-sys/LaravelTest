<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Rating System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Correct Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('movies.index') }}">🎬 Movie App</a>

            <div class="ml-auto d-flex align-items-center">
                @auth
                    <span class="me-2">Welcome, {{ Auth::user()->name }}</span>


                    <a href="{{ route('movies.create') }}" class="btn btn-outline-success btn-sm me-2">Create Movie</a>

                    <a href="{{ route('genres.index') }}" class="btn btn-outline-success btn-sm me-2">Genre</a>

                    <a href="{{ route('actors.index') }}" class="btn btn-outline-success btn-sm me-2">Actor</a>

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm me-2">Logout</button>
                    </form>



                    {{-- <!-- Profile Icon -->
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-info btn-sm me-2">
                        <i class="fa fa-user"></i>
                    </a> --}}
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>
</html>
