@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-body text-center">
                <h2 class="text-primary font-weight-bold">🎬 {{ $movie->title }}</h2>
                <p><strong>🎭 Genre:</strong> {{ $movie->genre->name }}</p> <!-- Fix: Use the genre relationship -->
                <p><strong>📅 Released Date:</strong> {{ \Carbon\Carbon::parse($movie->released_date)->format('F d, Y') }}
                </p>
                <p><strong>⭐️ Rating:</strong> {{ number_format($averageRating, 1) ?? 'No ratings yet' }}</p>
            </div>
        </div>
    </div>
@endsection
