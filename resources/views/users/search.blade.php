@extends('layouts')

@section('content')
<div class="container mt-5">

    <!-- Search Form -->
    <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="actor" class="form-control" placeholder="Search movies by actor name..." value="{{ request('actor') }}">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
        </div>
    </form>

    <!-- Search Result -->
    @if(isset($actorName))
        <h4 class="mb-3">Search results for "<strong>{{ $actorName }}</strong>"</h4>
    @endif

    @if($movies->isEmpty())
        <p class="text-muted">No movies found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Actor Name</th>
                    <th>Movie Title</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    @foreach($movie->actors as $actor)
                        @if(Str::contains(strtolower($actor->name), strtolower($actorName)))
                        <tr>
                            <td>{{ $actor->name }}</td>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->genre->name }}</td>
                        </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
