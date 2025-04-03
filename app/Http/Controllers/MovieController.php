<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        $movies = Movie::all();
        return view('movies.index',compact('movies'));
    }

    public function show($id){
        $movie = Movie::findOrFail($id);
        $ratings = $movie->ratings->avg('ratings');
        return view('movies.show',compact('movie','ratings'));
    }
}
