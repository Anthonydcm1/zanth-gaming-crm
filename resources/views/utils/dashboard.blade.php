@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="dashboard-card">
            <div class="welcome-header">
                <h1 class="gaming-font">Olá, {{ Auth::user()->name }}!</h1>
                <p class="text-muted">Bem-vindo ao teu centro de comando Zanth.</p>
            </div>

            <div class="status-grid">
                <div class="status-item">
                    <span class="status-label">Perfil</span>
                    <span class="status-value">{{ Auth::user()->user_type == 1 ? 'Administrador' : 'Utilizador' }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Email</span>
                    <span class="status-value">{{ Auth::user()->email }}</span>
                </div>
            </div>

            <div class="quick-link-section">
                <h3 class="section-title">Acesso Rápido</h3>
                <div class="quick-links">
                    @if (Auth::user()->player)
                        <a href="/profile" class="quick-link profile-link">
                            <i class="fa-solid fa-user"></i>
                            <span>Meu Perfil</span>
                        </a>
                    @endif
                    <a href="/teams" class="quick-link">
                        <i class="fa-solid fa-users"></i>
                        <span>Ver Equipas</span>
                    </a>
                    @if (Auth::user()->user_type == 1)
                        <a href="/teams/create" class="quick-link admin-link">
                            <i class="fa-solid fa-plus"></i>
                            <span>Inserir Equipa (Admin)</span>
                        </a>
                    @endif
                </div>
            </div>

            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Terminar Sessão
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 800px;
            margin: 40px auto;
        }

        .dashboard-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px;
            box-shadow: var(--shadow-premium);
        }

        .welcome-header {
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 20px;
        }

        .welcome-header h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .status-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .status-item {
            background: var(--bg-dark);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .status-label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .status-value {
            font-size: 1rem;
            font-weight: 600;
        }

        .quick-link-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .quick-links {
            display: flex;
            gap: 15px;
        }

        .quick-link {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .quick-link i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .quick-link:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .admin-link {
            border-color: rgba(230, 57, 70, 0.3);
        }

        .profile-link {
            border-color: rgba(52, 152, 219, 0.3);
        }

        .profile-link i {
            color: #3498db;
        }

        .profile-link:hover {
            border-color: #3498db;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid #ff4433;
            color: #ff4433;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-logout:hover {
            background: #ff4433;
            color: white;
        }
    </style>
@endsection
