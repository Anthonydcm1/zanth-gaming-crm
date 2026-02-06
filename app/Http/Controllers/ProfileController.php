<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Mostra os detalhes do perfil do utilizador autenticado e do seu jogador associado.
     */
    public function index()
    {
        $user = Auth::user();

        // Verifica se o utilizador tem um registo de jogador associado
        if (!$user || !$user->player) {
            return redirect()->route('dashboard')->with('error', 'Não tens um jogador associado ao teu perfil.');
        }

        $player = $user->player;

        return view('profile.profile', compact('player'));
    }

    /**
     * Mostra o formulário de edição do perfil.
     */
    public function edit()
    {
        $user = Auth::user();
        $player = $user->player;
        $teams = \App\Models\Team::all();

        return view('profile.edit', compact('player', 'teams'));
    }

    /**
     * Atualiza os dados do perfil do utilizador e do jogador associado.
     */
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

        // Tratamento do upload da foto de perfil
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('img/players'), $imageName);
            $data['photo'] = '/img/players/'.$imageName;
        }

        $player->update($data);

        // Atualiza o nome do utilizador na tabela users
        $user->update(['name' => $request->name]);

        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso!');
    }
}
