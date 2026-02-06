@extends('layouts.main_layout')

@section('content')
    <div class="container">
        {{-- Cabeçalho da Página --}}
        <div class="page-header">
            <h2 class="gaming-font">Novo Jogador</h2>
            <p class="text-muted">Adicionar um novo atleta à base de dados.</p>
        </div>

        {{-- Card de Formulário --}}
        <div class="form-card">
            <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Secção: Informações Básicas --}}
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

                    {{-- Upload de Foto --}}
                    <div class="form-group">
                        <label for="photo">Fotografia</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>
                </div>

                {{-- Secção: Detalhes Profissionais --}}
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
                        {{-- Status do Jogador --}}
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

                {{-- Secção: Links e Redes Sociais --}}
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

                {{-- Botões de Submissão --}}
                <div class="form-actions">
                    <a href="{{ route('players.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">Criar Jogador</button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        {{-- CSS para formulários --}}
        <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    @endpush
@endsection
