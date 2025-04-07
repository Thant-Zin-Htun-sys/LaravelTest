<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre')->orderByDesc('id')->get();

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {

        $averageRating = $movie->rating()->avg('rating');

        return view('movies.show', compact('movie', 'averageRating'));
    }

    public function create()
    {
        $genres = Genre::all();

        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'released_date' => 'required|date',
        ]);

        Movie::create([
            'title' => $request->title,
            'genre_id' => $request->genre_id,
            'released_date' => $request->released_date,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();

        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'genre_id' => 'required|exists:genres,id',
        'released_date' => 'required|date',
    ]);

    // Find the movie
    $movie = Movie::findOrFail($id);

    // Update movie attributes
    $movie->update([
        'title' => $request->title,
        'genre_id' => $request->genre_id,
        'released_date' => $request->released_date,
    ]);

    return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
}


    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}

