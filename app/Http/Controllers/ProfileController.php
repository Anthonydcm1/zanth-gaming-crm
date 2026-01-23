<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Se o utilizador não tiver jogador associado, redireciona para o dashboard
        if (!$user->player) {
            return redirect()->route('dashboard')->with('error', 'Não tens um jogador associado ao teu perfil.');
        }

        $player = $user->player;

        return view('profile.profile', compact('player'));
    }
}
