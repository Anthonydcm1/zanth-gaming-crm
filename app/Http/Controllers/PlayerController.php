<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with('team')->get();
        return view('players.index', compact('players'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('players.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'team_id' => 'required|exists:teams,id',
            'join_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'status' => 'required|in:Ativo,Reserva,Inativo',
            'rating' => 'nullable|string|max:255',
            'steam_url' => 'nullable|url',
            'twitch_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'discord_tag' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('players', 'public');
            $validated['photo'] = asset('storage/' . $path);
        }

        Player::create($validated);

        return redirect()->route('players.index')->with('success', 'Jogador criado com sucesso!');
    }

    public function edit(Player $player)
    {
        $teams = Team::all();
        return view('players.edit', compact('player', 'teams'));
    }

    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'team_id' => 'required|exists:teams,id',
            'join_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'status' => 'required|in:Ativo,Reserva,Inativo',
            'rating' => 'nullable|string|max:255',
            'steam_url' => 'nullable|url',
            'twitch_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'discord_tag' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('players', 'public');
            $validated['photo'] = asset('storage/' . $path);
        }

        $player->update($validated);

        return redirect()->route('players.index')->with('success', 'Jogador atualizado com sucesso!');
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('players.index')->with('success', 'Jogador eliminado com sucesso!');
    }
}
