<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
}




