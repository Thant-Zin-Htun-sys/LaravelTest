<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request,$movie_id){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::create([
            'user_id' => auth()->id(),
            'movie_id' => $movie_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('movies.show', $movie_id);
    }
}
