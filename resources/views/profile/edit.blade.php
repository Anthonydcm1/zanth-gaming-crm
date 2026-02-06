@extends('layouts.main_layout')

@section('content')
    <div class="container">
        {{-- Cabeçalho da Edição de Perfil --}}
        <div class="page-header">
            <div>
                <h2 class="gaming-font">Editar Perfil</h2>
                <p class="text-muted">Atualiza as tuas informações e redes sociais.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('profile') }}" class="btn-action">
                    <i class="fa-solid fa-arrow-left"></i> Voltar ao Perfil
                </a>
            </div>
        </div>

        {{-- Wrapper do Formulário de Edição --}}
        <div class="edit-profile-wrapper">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="gaming-form">
                @csrf
                @method('PUT')

                {{-- Secção: Informações Básicas e Avatar --}}
                <div class="form-section">
                    <h3 class="section-title"><i class="fa-solid fa-user-gear"></i> Informações Básicas</h3>

                    {{-- Upload de Avatar com Pré-visualização --}}
                    <div class="avatar-upload-group">
                        <div class="current-avatar">
                            <img src="{{ $player->photo ?? '/img/default_avatar.png' }}" id="avatar-preview" alt="Avatar">
                        </div>
                        <div class="upload-controls">
                            <label for="photo" class="btn-action">
                                <i class="fa-solid fa-camera"></i> Alterar Foto
                            </label>
                            <input type="file" id="photo" name="photo" style="display: none;"
                                onchange="previewImage(this)">
                            <p class="upload-hint">Formatos: JPG, PNG. Máx: 2MB</p>
                        </div>
                    </div>

                    {{-- Grelha de Campos de Texto --}}
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Nome Completo</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $player->name) }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nickname">Nickname (IGN)</label>
                            <input type="text" id="nickname" name="nickname"
                                value="{{ old('nickname', $player->nickname) }}" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="game"><i class="fa-solid fa-gamepad"></i> Jogo Principal</label>
                        <input type="text" id="game" name="game" value="{{ old('game', $player->game) }}"
                            required placeholder="Ex: Fortnite, Valorant, CS2">
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="role">Posição / Função</label>
                            <input type="text" id="role" name="role" value="{{ old('role', $player->role) }}"
                                placeholder="Ex: AWPer, IGL">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nacionalidade</label>
                            <input type="text" id="nationality" name="nationality"
                                value="{{ old('nationality', $player->nationality) }}" placeholder="Ex: Portugal">
                        </div>
                    </div>
                </div>

                {{-- Secção: Redes Sociais --}}
                <div class="form-section">
                    <h3 class="section-title"><i class="fa-solid fa-share-nodes"></i> Redes Sociais</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="steam_url"><i class="fa-brands fa-steam"></i> Steam URL</label>
                            <input type="url" id="steam_url" name="steam_url"
                                value="{{ old('steam_url', $player->steam_url) }}"
                                placeholder="https://steamcommunity.com/id/...">
                        </div>
                        <div class="form-group">
                            <label for="twitch_url"><i class="fa-brands fa-twitch"></i> Twitch URL</label>
                            <input type="url" id="twitch_url" name="twitch_url"
                                value="{{ old('twitch_url', $player->twitch_url) }}" placeholder="https://twitch.tv/...">
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="twitter_url"><i class="fa-brands fa-x-twitter"></i> Twitter URL</label>
                            <input type="url" id="twitter_url" name="twitter_url"
                                value="{{ old('twitter_url', $player->twitter_url) }}" placeholder="https://x.com/...">
                        </div>
                        <div class="form-group">
                            <label for="discord_tag"><i class="fa-brands fa-discord"></i> Discord Tag</label>
                            <input type="text" id="discord_tag" name="discord_tag"
                                value="{{ old('discord_tag', $player->discord_tag) }}" placeholder="User#0000">
                        </div>
                    </div>
                </div>

                {{-- Ações do Formulário --}}
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        {{-- CSS específico para edição de perfil --}}
        <link rel="stylesheet" href="{{ asset('css/profile-edit.css') }}">
    @endpush

    {{-- Script de Pré-visualização de Imagem --}}
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
