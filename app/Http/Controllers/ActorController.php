<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::all();

        return view('actors.index', compact('actors'));
    }

    /* For Search*/
    public function search(Request $request)
    {
        $search = $request->search;
        $actors = Actor::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $actors = Actor::all();

        return view('actors.create', compact('actors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $input = $request->all();
        Actor::create($input);
        return redirect()->route('actors.index')->with('success', 'Actors created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        return view('actors.edit', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $input = $request->all();
        $actor->update($input);
        return redirect()->route('actors.index')->with('success', 'Actor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->route('actors.index')->with('success', 'Actor deleted successfully');
    }
}
