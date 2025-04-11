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
        'actors' => 'required|string',
        'released_date' => 'required|date',
    ]);

    $movie = Movie::create([
        'title' => $request->title,
        'genre_id' => $request->genre_id,
        'released_date' => $request->released_date,
    ]);

    // Convert comma-separated names to array
    $actorNames = array_map('trim', explode(',', $request->actors));

    // Get or create actor IDs
    $actorIds = [];
    foreach ($actorNames as $name) {
        $actor = \App\Models\Actor::firstOrCreate(['name' => $name]);
        $actorIds[] = $actor->id;
    }

    // Attach actor IDs to movie
    $movie->actors()->attach($actorIds);

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
        'actors' => 'required|string',
        'released_date' => 'required|date',
    ]);

    $movie->update([
        'title' => $request->title,
        'genre_id' => $request->genre_id,
        'released_date' => $request->released_date,
    ]);

    // Parse comma-separated names
    $actorNames = array_map('trim', explode(',', $request->actors));

    $actorIds = [];
    foreach ($actorNames as $name) {
        $actor = \App\Models\Actor::firstOrCreate(['name' => $name]);
        $actorIds[] = $actor->id;
    }

    $movie->actors()->sync($actorIds);

    return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
}



    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->ratings()->delete();
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $movies = Movie::with('genre', 'actors')
            ->where('title', 'like', "%search%")
            ->orWhereHas('genre', function ($q) use ($search) {
                $q->where('name', 'like', "%search%");
            })
            ->orWhereHas('actors', function ($q) use ($search) {
                $q->where('name', 'like', "%search%");
            })
            ->orderByDec('id')
            ->get();

            return view('movies.index', compact('movies'));
    }

}
