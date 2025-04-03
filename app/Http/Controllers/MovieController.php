<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $averageRating = $movie->ratings()->avg('rating');
        return view('movies.show', compact('movie', 'averageRating'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'released_date' => 'required|date',
        ]);

        Movie::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'released_date' => $request->released_date,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'released_date' => 'required|date',
    ]);

    // Find the movie
    $movie = Movie::findOrFail($id);

    // Update movie attributes
    $movie->update([
        'title' => $request->title,
        'genre' => $request->genre,
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

