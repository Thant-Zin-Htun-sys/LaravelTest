@extends('layout')
@section('content')
<div class="card mt-5">
    <h2 class="card-header">Edit Movie</h2>
    
    <div class="card-body">
        
    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
    @csrf
    @method('PUT')  <!-- This specifies the HTTP method as PUT for updating -->
    <div class="form-group">
        <label for="name">Movie Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $movie->title }}" required>
    </div>

    <div class="form-group">
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" class="form-control" value="{{ $movie->genre }}" required>
    </div>

    <div class="form-group">
        <label for="released_date">Released Date</label>
        <input type="date" name="released_date" id="released_date" class="form-control" value="{{ $movie->released_date }}" required>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Update Movie</button>
</form>
    </div>
</div>
@endsection
