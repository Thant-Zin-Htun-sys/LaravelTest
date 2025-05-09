<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre')->orderByDesc('id')->get();

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $averageRating = $movie->ratings()->avg('rating');

        // Personalized Recommendations based on Genre
        $recommended = Movie::where('genre_id', $movie->genre_id)
            ->where('id', '!=', $movie->id)
            ->take(5)->get();

        return view('movies.show', compact('movie', 'averageRating', 'recommended'));
    }

    public function create()
    {
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies.create', compact('genres', 'actors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'actors' => 'required|array|min:1',
            'actors.*' => 'exists:actors,id',
            'released_date' => 'required|date',
        ]);

        $movie = Movie::create([
            'title' => $request->title,
            'genre_id' => $request->genre_id,
            'released_date' => $request->released_date,
        ]);

        // Attach actor IDs directly
        $movie->actors()->attach($request->actors);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }



    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies.edit', compact('movie', 'genres', 'actors'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'actors' => 'required|array|size:2', // exactly 2 actors
            'actors.*' => 'exists:actors,id',
            'released_date' => 'required|date',
        ]);

        // Update movie info
        $movie->update([
            'title' => $request->title,
            'genre_id' => $request->genre_id,
            'released_date' => $request->released_date,
        ]);

        // Sync actors (no need for explode or name lookup)
        $movie->actors()->sync($request->actors);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }




    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->ratings()->delete();
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
