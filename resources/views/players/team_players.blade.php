@extends('layouts.main_layout')

@section('content')
    <div class="container">
        {{-- Cabeçalho com Botão de Voltar --}}
        <div class="page-header">
            <div class="header-with-back">
                <a href="{{ route('teams.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i></a>
                <div>
                    <h2 class="gaming-font">Jogadores: {{ $team->name }}</h2>
                    <p class="text-muted">Plantel oficial e datas de recrutamento.</p>
                </div>
            </div>
        </div>

        {{-- Tabela de Jogadores da Equipa --}}
        <div class="table-wrapper">
            <table class="gaming-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome Artístico</th>
                        <th>Jogo</th>
                        <th>Data de Entrada</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        {{-- Linha de cada Jogador --}}
                        <tr>
                            <td>
                                <img src="{{ $player->photo }}" alt="{{ $player->name }}" class="player-photo">
                            </td>
                            <td><strong>{{ $player->name }}</strong></td>
                            <td><span class="badge">{{ $player->game ?? 'N/A' }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($player->join_date)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        {{-- Caso a equipa não tenha jogadores --}}
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 40px;">
                                Nenhum jogador encontrado para esta equipa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('styles')
        {{-- CSS específico para esta view --}}
        <link rel="stylesheet" href="{{ asset('css/team-players.css') }}">
    @endpush
@endsection
