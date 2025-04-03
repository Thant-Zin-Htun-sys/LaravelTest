@extends('layouts')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ $movie->name }}</h2>
            <p><strong>Genre:</strong> {{ $movie->genre }}</p>
            <p><strong>Released Date:</strong> {{ $movie->released_date }}</p>
            <p><strong>Average Rating:</strong> {{ $ratings ?? 'No ratings yet' }}</p>
        </div>
    </div>

    @auth
        <h4 class="mt-4">Rate this Movie</h4>
        <form action="{{ route('movies.rate', $movie->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Your Rating (1-5)</label>
                <select name="rating" id="rating" class="form-control" required>
                    <option value="1">1 - Bad</option>
                    <option value="2">2 - Okay</option>
                    <option value="3">3 - Good</option>
                    <option value="4">4 - Very Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Submit Rating</button>
        </form>
    @else
        <p class="mt-3"><a href="{{ route('login') }}">Login</a> to rate this movie.</p>
    @endauth
@endsection