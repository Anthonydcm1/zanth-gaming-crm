<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = \App\Models\Team::withCount('players')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {

        $request->validate(['name' => 'required', 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);

        $path = null;
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('teams', 'public');
        }

        \App\Models\Team::create([
            'name' => $request->name,
            'logo' => $path ? asset('storage/' . $path) : null
        ]);

        return redirect()->route('teams.index');
    }

    public function edit(\App\Models\Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, \App\Models\Team $team)
    {
        $request->validate(['name' => 'required', 'logo' => 'image|max:2048']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('teams', 'public');
            $team->logo = asset('storage/' . $path);
        }

        $team->name = $request->name;
        $team->save();

        return redirect()->route('teams.index');
    }

    public function destroy(\App\Models\Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index');
    }
}
