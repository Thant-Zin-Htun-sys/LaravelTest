@extends('layout')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Edit Movie</h2>

        <div class="card-body">
            <form action="{{ route('movies.update', $movie->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Movie Title -->
                <div class="form-group mb-3">
                    <label for="title"><strong>Movie Title:</strong></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $movie->title) }}" required>
                    @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Genre -->
                <div class="form-group mb-3">
                    <label for="genre_id"><strong>Genre:</strong></label>
                    <select name="genre_id" id="genre_id" class="form-control @error('genre_id') is-invalid @enderror" required>
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

                <!-- Actors using Select2 -->
                <div class="mb-3">
                    <label for="inputActors" class="form-label"><strong>Actors (Select 2):</strong></label>
                    <select name="actors[]" id="inputActors" class="form-select select2 @error('actors') is-invalid @enderror" multiple required>
                        @foreach($actors as $actor)
                            <option value="{{ $actor->id }}" 
                                {{ in_array($actor->id, old('actors', $movie->actors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $actor->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">You must select exactly 2 actors.</small>
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

                <button type="submit" class="btn btn-primary mt-3"><i class="fa-solid fa-floppydisk"></i> Update Movie</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary mt-3"><i class="fa fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include Select2 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Select2
            $('#inputActors').select2({
                placeholder: 'Select 2 actors',
                width: '100%'
            });

            // Limit selection to exactly 2
            $('#inputActors').on('change', function () {
                const selected = $(this).val();
                if (selected.length > 2) {
                    alert('You can only select 2 actors.');
                    // Remove the last selected option
                    selected.pop();
                    $(this).val(selected).trigger('change');
                }
            });
        });
    </script>
@endsection
