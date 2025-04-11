@extends('layout')
@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Edit Movie</h2>

        <div class="card-body">

            <form action="{{ route('movies.update', $movie->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This specifies the HTTP method as PUT for updating -->

                <!-- Movie Title -->
                <div class="form-group mb-3">
                    <label for="title"><strong>Movie Title:</strong></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $movie->title) }}" required>
                    @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Genre Dropdown -->
                <div class="form-group mb-3">
                    <label for="genre_id"><strong>Genre:</strong></label>
                    <select name="genre_id" id="genre_id" class="form-control @error('genre_id') is-invalid @enderror"
                        required>
                        <option value="">-- Select Genre --</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ (old('genre_id', $movie->genre_id) == $genre->id) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Actors -->
                <div class="mb-3">
                    <label for="inputActors" class="form-label"><strong>Actors:</strong></label>
                    <input type="text" name="actors" id="inputActors"
                        class="form-control @error('actors') is-invalid @enderror"
                        placeholder="Enter actor names separated by commas"
                        value="{{ old('actors', $movie->actors->pluck('name')->implode(', ')) }}">
                    <small class="form-text text-muted">Separate names by commas (e.g. Tom Hanks, Scarlett
                        Johansson).</small>
                    @error('actors')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Released Date -->
                <div class="form-group mb-3">
                    <label for="released_date"><strong>Released Date:</strong></label>
                    <input type="date" name="released_date" id="released_date"
                        class="form-control @error('released_date') is-invalid @enderror"
                        value="{{ old('released_date', $movie->released_date) }}" required>
                    @error('released_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-floppydisk"></i> Update
                    Movie</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary mt-3"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </form>

        </div>
    </div>
@endsection