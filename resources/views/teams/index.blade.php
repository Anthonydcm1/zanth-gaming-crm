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
                                        @if (auth()->user()->user_type == 1)
                                            <a href="{{ route('teams.edit', $team->id) }}" class="btn-action edit" title="Editar">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        @endif

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

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/teams.css') }}">
@endpush
@endsection
