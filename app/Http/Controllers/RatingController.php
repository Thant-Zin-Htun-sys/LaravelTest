<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $movie_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Here, we use a default user_id, such as 1 (or another placeholder)
        Rating::create([
            'user_id' => 1, // Default user_id (change this to a more appropriate value if needed)
            'movie_id' => $movie_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('movies.show', $movie_id);
    }
}
