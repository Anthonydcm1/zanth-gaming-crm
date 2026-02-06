@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="dashboard-card">
            {{-- Saudação ao Utilizador --}}
            <div class="welcome-header">
                <h1 class="gaming-font">Olá, {{ Auth::user()->name }}!</h1>
                <p class="text-muted">Bem-vindo ao teu centro de comando Zanth.</p>
            </div>

            {{-- Grid de Estatísticas Rápidas --}}
            <div class="status-grid">
                <div class="status-item">
                    <span class="status-label">Perfil</span>
                    <span class="status-value">{{ Auth::user()->user_type == 1 ? 'Administrador' : 'Utilizador' }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Email</span>
                    <span class="status-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Equipas</span>
                    <span class="status-value">{{ $totalTeams }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Jogadores</span>
                    <span class="status-value">{{ $totalPlayers }}</span>
                </div>
            </div>

            {{-- Secção de Gráficos (Distribuição de Jogos) --}}
            <div class="analytics-section">
                <h3 class="section-title">Distribuição de Jogos</h3>
                <div class="chart-container">
                    <canvas id="gamesChart"></canvas>
                </div>
            </div>

            {{-- Secção de Atalhos Rápidos --}}
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
                    {{-- Atalho de Admin --}}
                    @if (Auth::user()->user_type == 1)
                        <a href="/teams/create" class="quick-link admin-link">
                            <i class="fa-solid fa-plus"></i>
                            <span>Inserir Equipa (Admin)</span>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Botão de Logout --}}
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

    @push('styles')
        {{-- CSS específico do Dashboard --}}
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush

    @push('scripts')
        {{-- Biblioteca Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('gamesChart').getContext('2d');

                // Dados injetados pelo controlador Laravel
                const labels = {!! json_encode($gameLabels) !!};
                const data = {!! json_encode($gameCounts) !!};

                {{-- Configuração do Gráfico de Rosca --}}
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jogadores',
                            data: data,
                            backgroundColor: [
                                'rgba(139, 92, 246, 0.8)', // Roxo Primário
                                'rgba(59, 130, 246, 0.8)', // Azul
                                'rgba(236, 72, 153, 0.8)', // Rosa
                                'rgba(16, 185, 129, 0.8)', // Verde
                                'rgba(245, 158, 11, 0.8)', // Laranja
                                'rgba(99, 102, 241, 0.8)' // Índigo
                            ],
                            borderColor: 'rgba(17, 24, 39, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    color: '#9ca3af',
                                    font: {
                                        family: "'Orbitron', sans-serif"
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
