<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieMatch - Discover Your Next Favorite Movie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #1c1c1c, #343a40);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            text-align: center;
        }
        .btn-primary, .btn-success {
            padding: 12px 30px;
            font-size: 1.1rem;
            margin: 10px;
        }
        footer {
            background-color: #212529;
            color: #ccc;
            padding: 15px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="#">🎬 MovieMatch</a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div>
            <h1 class="display-4 fw-bold">Find Your Perfect Movie</h1>
            <p class="lead mt-3">Discover personalized movie recommendations based on your unique taste and ratings.</p>
            <a href="{{ route('register') }}" class="btn btn-success me-2">Get Started</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light">I already have an account</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} MovieMatch. All rights reserved.</p>
    </footer>

</body>
</html>
