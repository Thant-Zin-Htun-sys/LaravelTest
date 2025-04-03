<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function show($id){
        $movie = Movie::findOrFail($id);
        $averageRating = $movie->rating()->avg('rating');
        return view('movies.show', compact('movie','averageRating'));
    }
}
