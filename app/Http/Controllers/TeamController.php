<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Lista todas as equipas com a contagem de jogadores.
     */
    public function index()
    {
        $teams = \App\Models\Team::withCount('players')->get();
        return view('teams.index', compact('teams'));
    }

    /**
     * Mostra o formulário para criar uma nova equipa.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Guarda uma nova equipa na base de dados.
     */
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

    /**
     * Mostra o formulário para editar uma equipa existente.
     */
    public function edit(\App\Models\Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Atualiza os dados de uma equipa na base de dados.
     */
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

    /**
     * Remove uma equipa da base de dados.
     */
    public function destroy(\App\Models\Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index');
    }
}
