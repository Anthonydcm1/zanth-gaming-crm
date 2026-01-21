@extends('layouts.main_layout')

@section('content')
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="gaming-font">Bem-vindo ao ZANTH</h1>
            <p class="hero-subtitle">O CRM ideal para gestão de equipas e jogadores.</p>
            <div class="hero-actions">
                <a href="/teams" class="btn-primary">Explorar Equipas</a>
                <a href="/players" class="btn-secondary">Ver Plantel</a>
            </div>
        </div>
    </div>

    <style>
        .hero-section {
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: radial-gradient(circle at center, rgba(230, 57, 70, 0.05) 0%, transparent 70%);
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #fff, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .hero-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border);
            color: #fff;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.2);
        }
    </style>
@endsection
