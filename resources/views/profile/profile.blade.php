@extends('layouts.main_layout')

@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-banner">
                <div class="banner-overlay"></div>
            </div>

            <div class="profile-main">
                <div class="profile-avatar">
                    <img src="{{ $player->photo ?? 'https://via.placeholder.com/150' }}" alt="{{ $player->nickname }}">
                    <div class="status-indicator status-{{ strtolower($player->status) }}"></div>
                </div>

                <div class="profile-identity">
                    <h1 class="gaming-font">{{ $player->nickname }}</h1>
                    <p class="real-name">{{ $player->name }}</p>
                    <div style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;">
                        @if ($player->game)
                            <span class="role-tag"
                                style="background: rgba(255, 255, 255, 0.05); color: #fff; border-color: rgba(255, 255, 255, 0.2);">
                                <i class="fa-solid fa-gamepad" style="margin-right: 5px;"></i> {{ $player->game }}
                            </span>
                        @endif
                        @if ($player->role)
                            <span class="role-tag">{{ $player->role }}</span>
                        @endif
                        @if (Auth::id() == $player->user?->id)
                            <a href="{{ route('profile.edit') }}" class="btn-action"
                                style="padding: 6px 15px; border-radius: 20px;">
                                <i class="fa-solid fa-pen-to-square"></i> Editar Perfil
                            </a>
                        @endif
                    </div>
                </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <i class="fa-solid fa-users"></i>
                        <div>
                            <span class="stat-label">Equipa</span>
                            <span class="stat-value">{{ $player->team->name }}</span>
                        </div>
                    </div>

                    @if ($player->rating)
                        <div class="stat-item">
                            <i class="fa-solid fa-star"></i>
                            <div>
                                <span class="stat-label">Rating</span>
                                <span class="stat-value">{{ $player->rating }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="stat-item">
                        <i class="fa-solid fa-calendar"></i>
                        <div>
                            <span class="stat-label">Desde</span>
                            <span
                                class="stat-value">{{ \Carbon\Carbon::parse($player->join_date)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <div class="content-grid">
                <!-- Informações Pessoais -->
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="fa-solid fa-id-card"></i>
                        Informações Pessoais
                    </h3>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Nome Completo</span>
                            <span class="info-value">{{ $player->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nickname</span>
                            <span class="info-value">{{ $player->nickname }}</span>
                        </div>
                        @if ($player->nationality)
                            <div class="info-item">
                                <span class="info-label">Nacionalidade</span>
                                <span class="info-value">{{ $player->nationality }}</span>
                            </div>
                        @endif
                        <div class="info-item">
                            <span class="info-label">Status</span>
                            <span class="status-badge status-{{ strtolower($player->status) }}">
                                {{ $player->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Carreira -->
                <div class="info-card">
                    <h3 class="card-title">
                        <i class="fa-solid fa-trophy"></i>
                        Carreira
                    </h3>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Equipa Atual</span>
                            <span class="info-value">{{ $player->team->name }}</span>
                        </div>
                        @if ($player->role)
                            <div class="info-item">
                                <span class="info-label">Posição</span>
                                <span class="info-value">{{ $player->role }}</span>
                            </div>
                        @endif
                        <div class="info-item">
                            <span class="info-label">Data de Entrada</span>
                            <span
                                class="info-value">{{ \Carbon\Carbon::parse($player->join_date)->format('d/m/Y') }}</span>
                        </div>
                        @if ($player->rating)
                            <div class="info-item">
                                <span class="info-label">Rating</span>
                                <span class="info-value">{{ $player->rating }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Redes Sociais -->
                @if ($player->steam_url || $player->twitch_url || $player->twitter_url || $player->discord_tag)
                    <div class="info-card social-card">
                        <h3 class="card-title">
                            <i class="fa-solid fa-share-nodes"></i>
                            Redes Sociais
                        </h3>
                        <div class="social-grid">
                            @if ($player->steam_url)
                                <a href="{{ $player->steam_url }}" target="_blank" class="social-link steam">
                                    <i class="fa-brands fa-steam"></i>
                                    <span>Steam</span>
                                </a>
                            @endif
                            @if ($player->twitch_url)
                                <a href="{{ $player->twitch_url }}" target="_blank" class="social-link twitch">
                                    <i class="fa-brands fa-twitch"></i>
                                    <span>Twitch</span>
                                </a>
                            @endif
                            @if ($player->twitter_url)
                                <a href="{{ $player->twitter_url }}" target="_blank" class="social-link twitter">
                                    <i class="fa-brands fa-x-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                            @endif
                            @if ($player->discord_tag)
                                <div class="social-link discord">
                                    <i class="fa-brands fa-discord"></i>
                                    <span>{{ $player->discord_tag }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@endsection
