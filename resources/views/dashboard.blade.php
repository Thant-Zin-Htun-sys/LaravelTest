@extends('layouts')

@section('content')
<div class="container mt-5">
    <h2>Your Movie Recommendations</h2>

    @if(isset($recommended) && $recommended->count())
        <div class="mt-4">
            <h5>You might also like:</h5>
            <ul>
                @foreach($recommended as $movie)
                    <li><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></li>
                @endforeach
            </ul>
        </div>
    @else
        <p>No recommendations available at the moment.</p>
    @endif
</div>
@endsection
