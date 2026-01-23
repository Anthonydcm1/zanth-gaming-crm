@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="page-header">
            <h2 class="gaming-font">Novo Jogador</h2>
            <p class="text-muted">Adicionar um novo atleta à base de dados.</p>
        </div>

        <div class="form-card">
            <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-section">
                    <h3 class="section-title">Informações Básicas</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nome Completo *</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="nickname">Nickname (IGN) *</label>
                            <input type="text" id="nickname" name="nickname" required value="{{ old('nickname') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="team_id">Equipa *</label>
                            <select id="team_id" name="team_id" required>
                                <option value="">Selecionar equipa...</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="join_date">Data de Entrada *</label>
                            <input type="date" id="join_date" name="join_date" required value="{{ old('join_date') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Fotografia</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Detalhes do Jogador</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="role">Role/Posição</label>
                            <input type="text" id="role" name="role"
                                placeholder="Ex: IGL, Entry Fragger, Support..." value="{{ old('role') }}">
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nacionalidade</label>
                            <input type="text" id="nationality" name="nationality" placeholder="Ex: Portugal, Brasil..."
                                value="{{ old('nationality') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select id="status" name="status" required>
                                <option value="Ativo" {{ old('status') == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="Reserva" {{ old('status') == 'Reserva' ? 'selected' : '' }}>Reserva</option>
                                <option value="Inativo" {{ old('status') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating/Nível</label>
                            <input type="text" id="rating" name="rating"
                                placeholder="Ex: Level 10 Faceit, Radiant..." value="{{ old('rating') }}">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Links Sociais</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="steam_url"><i class="fa-brands fa-steam"></i> Steam URL</label>
                            <input type="url" id="steam_url" name="steam_url"
                                placeholder="https://steamcommunity.com/..." value="{{ old('steam_url') }}">
                        </div>

                        <div class="form-group">
                            <label for="twitch_url"><i class="fa-brands fa-twitch"></i> Twitch URL</label>
                            <input type="url" id="twitch_url" name="twitch_url" placeholder="https://twitch.tv/..."
                                value="{{ old('twitch_url') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="twitter_url"><i class="fa-brands fa-x-twitter"></i> Twitter/X URL</label>
                            <input type="url" id="twitter_url" name="twitter_url" placeholder="https://twitter.com/..."
                                value="{{ old('twitter_url') }}">
                        </div>

                        <div class="form-group">
                            <label for="discord_tag"><i class="fa-brands fa-discord"></i> Discord Tag</label>
                            <input type="text" id="discord_tag" name="discord_tag" placeholder="username#1234"
                                value="{{ old('discord_tag') }}">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('players.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">Criar Jogador</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            margin-bottom: 30px;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
        }

        .form-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--shadow-premium);
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-of-type {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.1rem;
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .form-group label i {
            margin-right: 5px;
            color: var(--primary);
        }

        .form-group input,
        .form-group select {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 12px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(230, 57, 70, 0.1);
        }

        .form-group input::placeholder {
            color: var(--text-muted);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn-primary,
        .btn-secondary {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
