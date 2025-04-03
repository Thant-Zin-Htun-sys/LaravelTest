@extends('layouts')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-primary font-weight-bold">🎬 Movies Collection</h1>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-dark text-white text-center">
                            <h5 class="card-title m-0">{{ $movie->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>🎭 Genre:</strong> {{ $movie->genre }}</p>
                            <p class="card-text"><strong>📅 Released:</strong> {{ $movie->released_date }}</p>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
