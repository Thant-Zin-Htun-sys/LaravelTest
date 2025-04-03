@extends('layout')
@section('content')
<div class="card mt-5">
    <h2 class="card-header">Edit Movie</h2>
    
    <div class="card-body">
        
        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Title -->
            <div class="mb-3">
                <label for="inputTitle" class="form-label"><strong>Title:</strong></label>
                <input type="text" name="title" value="{{ $movie->title }}"
                    class="form-control @error('title') is-invalid @enderror" id="inputTitle" placeholder="Enter movie title">
                @error('title')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Genre -->
            <div class="mb-3">
                <label for="inputGenre" class="form-label"><strong>Genre:</strong></label>
                <input type="text" name="genre" value="{{ $movie->genre }}"
                    class="form-control @error('genre') is-invalid @enderror" id="inputGenre" placeholder="Enter movie genre">
                @error('genre')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Released Date -->
            <div class="mb-3">
                <label for="inputReleasedDate" class="form-label"><strong>Released Date:</strong></label>
                <input type="date" name="released_date" value="{{ $movie->released_date }}"
                    class="form-control @error('released_date') is-invalid @enderror" id="inputReleasedDate">
                @error('released_date')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppydisk"></i> Update</button>
            <a class="btn btn-primary" href="{{ route('movies.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </form>
    </div>
</div>
@endsection
