<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Mostra o dashboard com estatísticas gerais do sistema.
     */
    public function index()
    {
        // Contagem total de equipas e jogadores
        $totalTeams = \App\Models\Team::count();
        $totalPlayers = \App\Models\Player::count();

        // Dados para o Gráfico (Jogadores por Jogo)
        $playersByGame = \App\Models\Player::select('game', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->whereNotNull('game')
            ->groupBy('game')
            ->get();

        // Prepara os dados (labels e valores) para o Chart.js
        $gameLabels = $playersByGame->pluck('game');
        $gameCounts = $playersByGame->pluck('total');

        return view('utils.dashboard', compact('totalTeams', 'totalPlayers', 'gameLabels', 'gameCounts'));
    }
}
