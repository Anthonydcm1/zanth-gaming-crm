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
                    @if ($player->role)
                        <span class="role-tag">{{ $player->role }}</span>
                    @endif
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
                            <span class="stat-value">{{ \Carbon\Carbon::parse($player->join_date)->format('d/m/Y') }}</span>
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

    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: var(--shadow-premium);
        }

        .profile-banner {
            height: 200px;
            background: linear-gradient(135deg, rgba(230, 57, 70, 0.3) 0%, rgba(41, 50, 60, 0.8) 100%);
            position: relative;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="rgba(230,57,70,0.1)"/></svg>');
            background-size: 50px;
            opacity: 0.3;
        }

        .profile-main {
            padding: 0 40px 40px;
            position: relative;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid var(--bg-surface);
            margin-top: -75px;
            position: relative;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-indicator {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 3px solid var(--bg-surface);
        }

        .status-indicator.status-ativo {
            background: #2ecc71;
        }

        .status-indicator.status-reserva {
            background: #f1c40f;
        }

        .status-indicator.status-inativo {
            background: #95a5a6;
        }

        .profile-identity {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .profile-identity h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .real-name {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .role-tag {
            display: inline-block;
            background: rgba(230, 57, 70, 0.1);
            color: var(--primary);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            border: 1px solid var(--primary);
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--bg-dark);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .stat-item i {
            font-size: 2rem;
            color: var(--primary);
        }

        .stat-item div {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .profile-content {
            margin-top: 30px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow-premium);
        }

        .card-title {
            font-size: 1.2rem;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            font-size: 1.3rem;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .info-value {
            font-size: 0.95rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-badge.status-ativo {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }

        .status-badge.status-reserva {
            background: rgba(241, 196, 15, 0.2);
            color: #f1c40f;
            border: 1px solid #f1c40f;
        }

        .status-badge.status-inativo {
            background: rgba(149, 165, 166, 0.2);
            color: #95a5a6;
            border: 1px solid #95a5a6;
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .social-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            border-radius: 10px;
            transition: var(--transition);
            font-weight: 600;
        }

        .social-link i {
            font-size: 1.5rem;
        }

        .social-link.steam {
            background: rgba(23, 26, 33, 0.3);
            color: #fff;
            border: 1px solid #171a21;
        }

        .social-link.steam:hover {
            background: #171a21;
            transform: translateY(-3px);
        }

        .social-link.twitch {
            background: rgba(145, 70, 255, 0.2);
            color: #9146ff;
            border: 1px solid #9146ff;
        }

        .social-link.twitch:hover {
            background: #9146ff;
            color: white;
            transform: translateY(-3px);
        }

        .social-link.twitter {
            background: rgba(29, 161, 242, 0.2);
            color: #1da1f2;
            border: 1px solid #1da1f2;
        }

        .social-link.twitter:hover {
            background: #1da1f2;
            color: white;
            transform: translateY(-3px);
        }

        .social-link.discord {
            background: rgba(88, 101, 242, 0.2);
            color: #5865f2;
            border: 1px solid #5865f2;
            cursor: default;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .social-grid {
                grid-template-columns: 1fr;
            }

            .profile-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
