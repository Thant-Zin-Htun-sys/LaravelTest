@extends('layouts')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-body text-center">
                <h2 class="text-primary font-weight-bold">🎬 {{ $movie->title }}</h2>
                <p><strong>🎭 Genre:</strong> {{ $movie->genre }}</p>
                <p><strong>📅 Released Date:</strong> {{ $movie->released_date }}</p>
                <p><strong>⭐ Rating:</strong> {{ number_format($averageRating, 1) ?? 'No ratings yet' }}</p>
            </div>
        </div>

        <!-- Rating form with star rating -->
        <h4 class="mt-4 text-center">Rate this Movie</h4>
        <form action="{{ route('movies.rate', $movie->id) }}" method="POST" class="text-center">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Your Rating</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5">⭐</label>
                    <input type="radio" id="star4" name="rating" value="4" required /><label for="star4">⭐</label>
                    <input type="radio" id="star3" name="rating" value="3" required /><label for="star3">⭐</label>
                    <input type="radio" id="star2" name="rating" value="2" required /><label for="star2">⭐</label>
                    <input type="radio" id="star1" name="rating" value="1" required /><label for="star1">⭐</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit Rating</button>
        </form>
    </div>

    <style>
        .star-rating {
            direction: rtl;
            display: inline-flex;
            font-size: 2rem;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            cursor: pointer;
            color: gray;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
    </style>
@endsection
