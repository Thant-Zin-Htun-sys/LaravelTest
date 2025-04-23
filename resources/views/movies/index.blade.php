@extends('layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-primary font-weight-bold">🎬 Movies Collection</h1>
        <div class="row g-4">
            @foreach ($movies as $movie)
                <div class="col-md-4 d-flex">
                    <div class="card shadow-sm border-0 w-100 d-flex flex-column h-100">
                        <div class="card-header bg-dark text-white text-center">
                            <h5 class="card-title m-0 text-truncate" title="{{ $movie->title }}">
                                {{ $movie->title }}
                            </h5>
                        </div>
                        <div class="card-body flex-grow-1">
                            <p class="card-text"><strong>👤 Actors:</strong>
                                @foreach ($movie->actors as $actor)
                                    {{ $actor->name }}@if (!$loop->last), @endif
                                @endforeach
                            </p>
                            <p class="card-text"><strong>🎭 Genre:</strong> {{ $movie->genre->name }}</p>
                            <p class="card-text"><strong>📅 Released:</strong>
                                {{ \Carbon\Carbon::parse($movie->released_date)->format('M-d-Y') }}</p>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <a href="{{ route('movies.show', ['movie' => $movie->id]) }}" class="btn btn-info btn-sm">
                                View Details
                            </a>
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-primary btn-sm">
                                Update
                            </a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this movie?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
