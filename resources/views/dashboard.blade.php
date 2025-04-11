@extends('layouts')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 text-success fw-bold">🎯 Your Movie Recommendations</h1>

    @if(isset($recommended) && $recommended->count())
        <!-- Movie Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($recommended as $movie)
                <div class="col">
                    <div class="card h-100 shadow-lg border-0">
                        <div class="card-header bg-dark text-white text-center">
                            <h5 class="card-title mb-0">{{ $movie->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>🎭 Genre:</strong> {{ $movie->genre->name }}</p>
                            <p><strong>👤 Actors:</strong>
                                @foreach ($movie->actors as $actor)
                                    {{ $actor->name }}@if (!$loop->last), @endif
                                @endforeach
                            </p>
                            <p><strong>📅 Released:</strong> {{ \Carbon\Carbon::parse($movie->released_date)->format('M d, Y') }}</p>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <a href="{{ route('users.show', ['movie' => $movie->id]) }}" class="btn btn-outline-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center mt-5">
            <p class="text-muted fs-5">No recommendations available at the moment. Try rating more movies!</p>
        </div>
    @endif

    <div class="text-center mb-4">
        <a href="{{ route('users.home') }}" class="btn btn-secondary">
            <i class="fa fa-home"></i> Back to Home
        </a>
    </div>

</div>
@endsection
