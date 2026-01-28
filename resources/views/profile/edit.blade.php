@extends('layouts.main_layout')

@section('content')
    <div class="container">
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

        <div class="edit-profile-wrapper">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="gaming-form">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <h3 class="section-title"><i class="fa-solid fa-user-gear"></i> Informações Básicas</h3>

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

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar Alterações
                    </button>
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

        .edit-profile-wrapper {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px;
            box-shadow: var(--shadow-premium);
        }

        .form-section {
            margin-bottom: 40px;
        }

        .section-title {
            color: var(--primary);
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-upload-group {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.02);
            padding: 20px;
            border-radius: 12px;
        }

        .current-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            overflow: hidden;
        }

        .current-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-hint {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group input {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 15px;
            color: var(--text-main);
            transition: var(--transition);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(230, 57, 70, 0.2);
        }

        .form-actions {
            margin-top: 20px;
            padding-top: 30px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .avatar-upload-group {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

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
