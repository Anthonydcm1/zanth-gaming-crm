@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="page-header">
            <div>
                <h2 class="gaming-font">Gestão de Utilizadores</h2>
                <p class="text-muted">Promove jogadores a administradores ou gere permissões da equipa.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success"
                style="background: rgba(46, 204, 113, 0.2); color: #2ecc71; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #2ecc71;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger"
                style="background: rgba(231, 76, 60, 0.2); color: #e74c3c; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e74c3c;">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table class="gaming-table">
                <thead>
                    <tr>
                        <th>Utilizador</th>
                        <th>Email</th>
                        <th>Ficha de Jogador / Equipa</th>
                        <th>Tipo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <img src="{{ $user->player->photo ?? '/img/default_avatar.png' }}"
                                        style="width: 35px; height: 35px; border-radius: 50%; border: 1px solid var(--primary);">
                                    <strong>{{ $user->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->player)
                                    <span style="color: var(--primary);">{{ $user->player->nickname }}</span>
                                    <span class="text-muted"
                                        style="font-size: 0.8rem;">({{ $user->player->team->name ?? 'Sem Equipa' }})</span>
                                @else
                                    <span class="text-muted">Nenhuma</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->user_type == 1)
                                    <span class="badge"
                                        style="background: rgba(230, 57, 70, 0.2); border: 1px solid var(--primary);">ADMIN</span>
                                @else
                                    <span class="badge"
                                        style="background: rgba(255, 255, 255, 0.05); color: var(--text-muted);">USER</span>
                                @endif
                            </td>
                            <td class="actions-cell">
                                <div class="actions-wrapper">
                                    @if ($user->id !== Auth::id())
                                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn-action {{ $user->user_type == 1 ? 'delete' : '' }}"
                                                title="{{ $user->user_type == 1 ? 'Remover Admin' : 'Promover a Admin' }}"
                                                onclick="return confirm('Tem a certeza que deseja alterar as permissões de {{ $user->name }}?')">
                                                @if ($user->user_type == 1)
                                                    <i class="fa-solid fa-user-minus"></i> Remover Admin
                                                @else
                                                    <i class="fa-solid fa-user-shield"></i> Tornar Admin
                                                @endif
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            style="margin-left: 8px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Apagar Utilizador"
                                                onclick="return confirm('ATENÇÃO: Deseja apagar permanentemente o utilizador {{ $user->name }} e a sua ficha de jogador?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted" style="font-size: 0.8rem;">(Tu)</span>
                                    @endif
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
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
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
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center !important;
        }

        .actions-wrapper {
            display: flex;
            justify-content: center;
        }

        .btn-action {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
        }

        .btn-action:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-action.delete:hover {
            background: #e74c3c;
            border-color: #e74c3c;
        }
    </style>
@endsection
