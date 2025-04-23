@extends('layout')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Add New Movie</h2>
        <br>
        <div class="card-body">

            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="inputTitle" class="form-label"><strong>Title:</strong></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="inputTitle" placeholder="Enter movie title" value="{{ old('title') }}">
                    @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Genre -->
                <div class="mb-3">
                    <label for="inputGenre" class="form-label"><strong>Genre:</strong></label>
                    <select name="genre_id" class="form-control @error('genre_id') is-invalid @enderror" id="inputGenre"
                        required>
                        <option value="">-- Select Genre --</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Actors --}}
                <div class="mb-3">
                    <label for="inputActors" class="form-label"><strong>Actors (Select 2):</strong></label>
                    <select name="actors[]" class="form-control @error('actors') is-invalid @enderror" id="inputActors"
                        multiple required>
                        @foreach($actors as $actor)
                            <option value="{{ $actor->id }}" {{ collect(old('actors'))->contains($actor->id) ? 'selected' : '' }}>
                                {{ $actor->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Select exactly 2 actors (Hold Ctrl/Command to select).</small>
                    @error('actors')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Released Date -->
                <div class="mb-3">
                    <label for="inputReleasedDate" class="form-label"><strong>Released Date:</strong></label>
                    <input type="date" name="released_date"
                        class="form-control @error('released_date') is-invalid @enderror" id="inputReleasedDate"
                        value="{{ old('released_date') }}">
                    @error('released_date')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppydisk"></i> Submit</button>
                <a class="btn btn-primary" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const actorSelect = document.getElementById('inputActors');
        actorSelect.addEventListener('change', function () {
            let selectedOptions = Array.from(this.selectedOptions);
            if (selectedOptions.length > 2) {
                alert('Please select only two actors.');
                selectedOptions.forEach(option => option.selected = false);
            }
        });
    });
</script>
@endsection
