@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="header-with-back">
                <a href="{{ route('teams.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i></a>
                <div>
                    <h2 class="gaming-font">Jogadores: {{ $team->name }}</h2>
                    <p class="text-muted">Plantel oficial e datas de recrutamento.</p>
                </div>
            </div>
        </div>

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
                        <tr>
                            <td>
                                <img src="{{ $player->photo }}" alt="{{ $player->name }}" class="player-photo">
                            </td>
                            <td><strong>{{ $player->name }}</strong></td>
                            <td><span class="badge">{{ $player->game ?? 'N/A' }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($player->join_date)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
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

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header-with-back {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-back {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 50%;
            color: var(--text-main);
        }

        .btn-back:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .table-wrapper {
            background: var(--bg-surface);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: var(--shadow-premium);
        }

        .gaming-table {
            width: 100%;
            border-collapse: collapse;
        }

        .gaming-table th {
            text-align: left;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.02);
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .gaming-table td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .player-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: var(--bg-dark);
        }
    </style>
@endsection
