@extends('layouts')

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

        <!-- Recommended Movies -->
        @if ($recommended->count())
            <div class="mt-4">
                <h5>You might also like:</h5>
                <ul>
                    @foreach ($recommended as $rec)
                        <li><a href="{{ route('movies.show', $rec->id) }}">{{ $rec->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Rating form with star rating -->
        <h4 class="mt-4 text-center">Rate this Movie</h4>
        <form action="{{ route('movies.rate', $movie->id) }}" method="POST" class="text-center" id="ratingForm">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Your Rating: </label>
                <div class="star-rating" id="starRating">
                    <i class="fa-solid fa-star" data-value="1"></i>
                    <i class="fa-solid fa-star" data-value="2"></i>
                    <i class="fa-solid fa-star" data-value="3"></i>
                    <i class="fa-solid fa-star" data-value="4"></i>
                    <i class="fa-solid fa-star" data-value="5"></i>
                </div>
                <input type="hidden" name="rating" id="ratingValue">
            </div>
            <button type="submit" class="btn btn-success">Submit Rating</button>
            <a href="{{ route('movies.index') }}" class="btn btn-primary">Back</a>
        </form>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const stars = document.querySelectorAll(".star-rating i");
                const ratingInput = document.getElementById("ratingValue");

                stars.forEach(star => {
                    star.addEventListener("click", function() {
                        let rating = this.getAttribute("data-value");
                        ratingInput.value = rating; // Store selected rating

                        // Reset all stars
                        stars.forEach(s => s.classList.remove("active"));

                        // Highlight selected stars
                        for (let i = 0; i < rating; i++) {
                            stars[i].classList.add("active");
                        }
                    });
                });
            });
        </script>

        <style>
            .star-rating {
                direction: ltr;
                display: inline-flex;
                gap: 5px;
                cursor: pointer;
            }

            .star-rating i {
                color: #e6e6e6;
                font-size: 25px;
                transition: color 0.2s ease;
            }

            .star-rating i.active {
                color: #ff9c1a;
            }
        </style>
    </div>
@endsection
