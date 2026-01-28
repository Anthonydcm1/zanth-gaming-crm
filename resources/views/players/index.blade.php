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
                            <a href="{{ route('players.edit', $player->id) }}" class="btn-action edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
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

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-left: 4px solid var(--primary);
            padding-left: 20px;
        }

        .btn-primary-small {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .player-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: var(--transition);
            position: relative;
        }

        .player-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-premium);
            border-color: var(--primary);
        }

        .player-header {
            position: relative;
            background: linear-gradient(135deg, rgba(230, 57, 70, 0.1) 0%, rgba(41, 50, 60, 0.3) 100%);
            padding: 20px;
            text-align: center;
        }

        .player-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            object-fit: cover;
        }

        .player-status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-ativo {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }

        .status-reserva {
            background: rgba(241, 196, 15, 0.2);
            color: #f1c40f;
            border: 1px solid #f1c40f;
        }

        .status-inativo {
            background: rgba(149, 165, 166, 0.2);
            color: #95a5a6;
            border: 1px solid #95a5a6;
        }

        .player-info {
            padding: 20px;
        }

        .player-nickname {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .player-name {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .role-badge {
            display: inline-block;
            background: rgba(230, 57, 70, 0.1);
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .player-details {
            margin: 15px 0;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 0.85rem;
        }

        .detail-item i {
            color: var(--primary);
            width: 16px;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .social-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: var(--transition);
            cursor: pointer;
        }

        .social-icon.steam {
            background: rgba(23, 26, 33, 0.5);
            color: #171a21;
            border: 1px solid #171a21;
        }

        .social-icon.steam:hover {
            background: #171a21;
            color: white;
        }

        .social-icon.twitch {
            background: rgba(145, 70, 255, 0.2);
            color: #9146ff;
            border: 1px solid #9146ff;
        }

        .social-icon.twitch:hover {
            background: #9146ff;
            color: white;
        }

        .social-icon.twitter {
            background: rgba(29, 161, 242, 0.2);
            color: #1da1f2;
            border: 1px solid #1da1f2;
        }

        .social-icon.twitter:hover {
            background: #1da1f2;
            color: white;
        }

        .social-icon.discord {
            background: rgba(88, 101, 242, 0.2);
            color: #5865f2;
            border: 1px solid #5865f2;
        }

        .social-icon.discord:hover {
            background: #5865f2;
            color: white;
        }

        .player-actions {
            display: flex;
            gap: 10px;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.02);
            border-top: 1px solid var(--border);
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
            cursor: pointer;
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
    </style>
@endsection
