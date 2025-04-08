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
                            <p class="card-text"><strong>🎭 Genre:</strong> {{ $movie->genre->name }}</p>
                            <p class="card-text"><strong>📅 Released:</strong>
                                {{ \Carbon\Carbon::parse($movie->released_date)->format('M-d-Y') }}</p>
                        </div>
                        <div class="card-footer text-center bg-light">
                            <a href="{{ route('users.show', ['movie' => $movie->id]) }}" class="btn btn-info btn-sm">View Details</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
