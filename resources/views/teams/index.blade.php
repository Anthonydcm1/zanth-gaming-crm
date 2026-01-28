@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="page-header">
            <div>
                <h2 class="gaming-font">Equipas ZANTH</h2>
                <p class="text-muted">Gere as tuas lineups e consulta o desempenho global.</p>
            </div>
            <div class="header-actions">
                @if (auth()->check() && auth()->user()->user_type == 1)
                    <a href="{{ route('teams.create') }}" class="btn-primary-small"><i class="fa-solid fa-plus"></i> Nova
                        Equipa</a>
                @endif
            </div>
        </div>

        <div class="table-wrapper">
            <table class="gaming-table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nome da Equipa</th>
                        <th>Jogadores Ativos</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>
                                <img src="{{ $team->logo }}" alt="{{ $team->name }}" class="team-logo-small">
                            </td>
                            <td><strong>{{ $team->name }}</strong></td>
                            <td>
                                <span class="badge">{{ $team->players_count }} Atletas</span>
                            </td>
                            <td class="actions-cell">
                                <div class="actions-wrapper">
                                    <a href="{{ route('teams.players', $team->id) }}" class="btn-action"
                                        title="Ver Jogadores">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    @auth
                                        <a href="{{ route('teams.edit', $team->id) }}" class="btn-action edit" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        @if (auth()->user()->user_type == 1)
                                            <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" title="Apagar"
                                                    onclick="return confirm('Tem a certeza?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 30px;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
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
            letter-spacing: 1px;
        }

        .gaming-table td {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .team-logo-small {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--bg-dark);
        }

        .badge {
            background: rgba(230, 57, 70, 0.1);
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .btn-action {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }

        .btn-action.edit:hover {
            background: #3498db;
            border-color: #3498db;
        }

        .btn-action.delete:hover {
            background: #e74c3c;
            border-color: #e74c3c;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-primary-small {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .text-center {
            text-align: center !important;
        }

        .actions-cell {
            text-align: center;
        }

        .actions-wrapper {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
