<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->player) {
            return redirect()->route('dashboard')->with('error', 'Não tens um jogador associado ao teu perfil.');
        }

        $player = $user->player;

        return view('profile.profile', compact('player'));
    }

    public function edit()
    {
        $user = Auth::user();
        $player = $user->player;
        $teams = \App\Models\Team::all();

        return view('profile.edit', compact('player', 'teams'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $player = $user->player;

        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'game' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'steam_url' => 'nullable|url',
            'twitch_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'discord_tag' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'name', 'nickname', 'game', 'role', 'nationality',
            'steam_url', 'twitch_url', 'twitter_url', 'discord_tag'
        ]);

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('img/players'), $imageName);
            $data['photo'] = '/img/players/'.$imageName;
        }

        $player->update($data);

        // Atualizar nome do user também se necessário
        $user->update(['name' => $request->name]);

        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso!');
    }
}
