<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        $movies = Movie::with('genre', 'actors')->orderByDesc('id')->get();

        return view('users.home', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $averageRating = $movie->ratings()->avg('rating');

        // Personalized Recommendations based on Genre
        $recommended = Movie::where('genre_id', $movie->genre_id)
            ->where('id', '!=', $movie->id)
            ->take(5)->get();

        return view('users.show', compact('movie', 'averageRating', 'recommended'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        $ratings = Rating::with('movie')
            ->where('user_id', $user->id)
            ->get();

        if ($ratings->isEmpty()) {
            return view('dashboard', ['recommended' => collect()]);
        }

        $topGenres = $ratings->groupBy('movie.genre_id')
            ->map(fn($group) => $group->avg('rating'))
            ->sortDesc()
            ->take(2)
            ->keys();

        $recommended = Movie::with('genre')
            ->whereIn('genre_id', $topGenres)
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', ['recommended' => $recommended]);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $movies = Movie::where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")
                ->orWhereHas('genre', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                })
                ->orWhereHas('actors', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                });
        })->get();

        return view('users.home', compact('movies'));
    }
}
