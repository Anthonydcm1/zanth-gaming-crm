<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas Gerais
        $totalTeams = \App\Models\Team::count();
        $totalPlayers = \App\Models\Player::count();

        // Dados para o Gráfico (Jogadores por Jogo)
        // Agrupa por jogo e conta quantos jogadores existem em cada um
        $playersByGame = \App\Models\Player::select('game', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->whereNotNull('game')
            ->groupBy('game')
            ->get();

        // Prepara arrays para o Chart.js
        $gameLabels = $playersByGame->pluck('game');
        $gameCounts = $playersByGame->pluck('total');

        return view('utils.dashboard', compact('totalTeams', 'totalPlayers', 'gameLabels', 'gameCounts'));
    }
}
