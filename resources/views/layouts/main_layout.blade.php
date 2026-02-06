<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zanth Gaming CRM</title>

    {{-- Fontes do Google --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@400;700&display=swap"
        rel="stylesheet">

    {{-- Ficheiros CSS Globais --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">

    {{-- Font Awesome para Ícones --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- CSS específico de cada página --}}
    @stack('styles')
</head>

<body>

    {{-- Barra de Navegação --}}
    <nav class="navbar">
        <div class="nav-container">
            {{-- Logo --}}
            <a href="/" class="nav-logo">
                <span class="logo-z">Z</span>ANTH
            </a>

            {{-- Links do Menu --}}
            <ul class="nav-menu">
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Produtos <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="dropdown-mega">
                        {{-- Dropdown de Equipas --}}
                        <div class="dropdown-column">
                            <span class="dropdown-title">Equipas</span>
                            <a href="/teams" class="dropdown-item">
                                <div class="item-icon"><i class="fa-solid fa-users"></i></div>
                                <div class="item-text">
                                    <strong>Gestão de Equipas</strong>
                                    <span>Visualiza e edita as tuas lineups.</span>
                                </div>
                            </a>
                            @if (Auth::check() && Auth::user()->user_type == 1)
                                <a href="/teams/create" class="dropdown-item">
                                    <div class="item-icon"><i class="fa-solid fa-plus"></i></div>
                                    <div class="item-text">
                                        <strong>Criar Equipas</strong>
                                        <span>Adiciona novos talentos.</span>
                                    </div>
                                </a>
                            @endif
                        </div>
                        {{-- Dropdown de Jogadores --}}
                        <div class="dropdown-column">
                            <span class="dropdown-title">Jogadores</span>
                            <a href="/players" class="dropdown-item">
                                <div class="item-icon"><i class="fa-solid fa-user-ninja"></i></div>
                                <div class="item-text">
                                    <strong>Plantel</strong>
                                    <span>Base de dados de atletas.</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">Dashboard</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a href="/about" class="nav-link">Sobre</a>
                </li>
                {{-- Link de Gestão (Apenas para Admins) --}}
                @auth
                    @if (Auth::user()->user_type == 1)
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link" style="color: var(--primary);">
                                <i class="fa-solid fa-user-shield"></i> Gestão
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- Ações do Utilizador (Login / Perfil) --}}
            <div class="nav-actions">
                @auth
                    <a href="/profile" class="user-profile">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @else
                    <a href="/login" class="btn-login">Login</a>
                @endauth
                {{-- Botão Menu Mobile --}}
                <button class="mobile-menu-btn" id="mobile-menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    {{-- Scripts JS do Menu Mobile --}}
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');
        const hasDropdowns = document.querySelectorAll('.has-dropdown');

        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-xmark');
        });

        // Alternar dropdowns em dispositivos móveis
        hasDropdowns.forEach(item => {
            item.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    item.classList.toggle('active');
                }
            });
        });
    </script>

    {{-- Conteúdo Dinâmico da Página --}}
    <main class="content">
        @yield('content')
    </main>

    {{-- Rodapé --}}
    <footer class="footer">
        <p>&copy; 2026 Zanth Gaming. criado por AnthonyM. Todos os direitos reservados.</p>
    </footer>

    {{-- Scripts específicos de cada página --}}
    @stack('scripts')
</body>

</html>
