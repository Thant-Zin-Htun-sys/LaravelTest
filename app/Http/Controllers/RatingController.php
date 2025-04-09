<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $movieId)
    {

        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to rate movies.');
        }

        // Validate the rating
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Get the logged-in user ID
        $userId = Auth::id();

        // Find the movie
        $movie = Movie::findOrFail($movieId);

        // Save or update the rating for the logged-in user
        Rating::updateOrCreate(
            [
                'user_id' => $userId, // Ensure this uses the correct user ID
                'movie_id' => $movie->id,
            ],
            [
                'rating' => $validated['rating'],
            ]
        );

        // Redirect back with a success message
        return redirect()->route('users.show', $movie->id)->with('success', 'Rating saved!');
    }
}
