@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="page-header">
            <div>
                <h2 class="gaming-font">Jogadores ZANTH</h2>
                <p class="text-muted">Gestão completa de atletas e suas informações.</p>
            </div>
            <div class="header-actions">
                @if (auth()->check() && auth()->user()->user_type == 1)
                    <a href="{{ route('players.create') }}" class="btn-primary-small">
                        <i class="fa-solid fa-plus"></i> Novo Jogador
                    </a>
                @endif
            </div>
        </div>

        <div class="players-grid">
            @foreach ($players as $player)
                <div class="player-card">
                    <div class="player-header">
                        <img src="{{ $player->photo ?? 'https://via.placeholder.com/100' }}" alt="{{ $player->nickname }}"
                            class="player-photo">
                        <div class="player-status-badge status-{{ strtolower($player->status) }}">
                            {{ $player->status }}
                        </div>
                    </div>

                    <div class="player-info">
                        <h3 class="player-nickname">{{ $player->nickname }}</h3>
                        <p class="player-name">{{ $player->name }}</p>

                        <div style="margin-bottom: 10px; display: flex; gap: 5px; flex-wrap: wrap;">
                            @if ($player->game)
                                <span class="role-badge"
                                    style="background: rgba(255, 255, 255, 0.05); color: #fff; border: 1px solid rgba(255, 255, 255, 0.1);">
                                    <i class="fa-solid fa-gamepad"></i> {{ $player->game }}
                                </span>
                            @endif
                            @if ($player->role)
                                <span class="role-badge">{{ $player->role }}</span>
                            @endif
                        </div>

                        <div class="player-details">
                            <div class="detail-item">
                                <i class="fa-solid fa-users"></i>
                                <span>{{ $player->team->name }}</span>
                            </div>

                            @if ($player->nationality)
                                <div class="detail-item">
                                    <i class="fa-solid fa-flag"></i>
                                    <span>{{ $player->nationality }}</span>
                                </div>
                            @endif

                            @if ($player->rating)
                                <div class="detail-item">
                                    <i class="fa-solid fa-star"></i>
                                    <span>{{ $player->rating }}</span>
                                </div>
                            @endif

                            <div class="detail-item">
                                <i class="fa-solid fa-calendar"></i>
                                <span>{{ \Carbon\Carbon::parse($player->join_date)->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        @if ($player->steam_url || $player->twitch_url || $player->twitter_url || $player->discord_tag)
                            <div class="social-links">
                                @if ($player->steam_url)
                                    <a href="{{ $player->steam_url }}" target="_blank" class="social-icon steam">
                                        <i class="fa-brands fa-steam"></i>
                                    </a>
                                @endif
                                @if ($player->twitch_url)
                                    <a href="{{ $player->twitch_url }}" target="_blank" class="social-icon twitch">
                                        <i class="fa-brands fa-twitch"></i>
                                    </a>
                                @endif
                                @if ($player->twitter_url)
                                    <a href="{{ $player->twitter_url }}" target="_blank" class="social-icon twitter">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                @endif
                                @if ($player->discord_tag)
                                    <div class="social-icon discord" title="{{ $player->discord_tag }}">
                                        <i class="fa-brands fa-discord"></i>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    @auth
                        <div class="player-actions">
                            @if (auth()->user()->user_type == 1)
                                <a href="{{ route('players.edit', $player->id) }}" class="btn-action edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            @endif
                            @if (auth()->user()->user_type == 1)
                                <form action="{{ route('players.destroy', $player->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" onclick="return confirm('Tem a certeza?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/players.css') }}">
@endpush
@endsection
