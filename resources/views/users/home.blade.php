@extends('layouts')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5 text-primary fw-bold">🎬 Movies Collection</h1>

    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <form action="{{ route('users.search') }}" method="GET" class="input-group shadow-sm">
                <input type="text" name="search" class="form-control form-control-lg"
                    placeholder="Search by title, genre, or actor..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary btn-lg" type="submit">
                    <i class="fa fa-search"></i>&nbsp; Search
                </button>
            </form>
        </div>
    </div>

    <!-- Movie Cards -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($movies as $movie)
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
        @empty
            <div class="col-12 text-center">
                <p class="text-muted fs-5">No movies found. Try a different search!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
