@extends('layouts')

@section('content')
    <h1 class="text-center mb-4">Movies</h1>
    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        {{-- <h5 class="card-title">{{ $movie->title }}</h5> --}}
                        <p class="card-text"><strong>Movie:</strong> {{ $movie->title }}</p>
                        <p class="card-text"><strong>Genre:</strong> {{ $movie->genre }}</p>
                        <p class="card-text"><strong>Released:</strong> {{ $movie->released_date }}</p>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
