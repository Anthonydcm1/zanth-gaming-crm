<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zanth Gaming CRM</title>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Orbitron:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">
                <span class="logo-z">Z</span>ANTH
            </a>

            <ul class="nav-menu">
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link">Produtos <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="dropdown-mega">
                        <div class="dropdown-column">
                            <span class="dropdown-title">Equipas</span>
                            <a href="/teams" class="dropdown-item">
                                <div class="item-icon"><i class="fa-solid fa-users"></i></div>
                                <div class="item-text">
                                    <strong>Gestão de Equipas</strong>
                                    <span>Visualiza e edita as tuas lineups.</span>
                                </div>
                            </a>
                            <a href="/teams/create" class="dropdown-item">
                                <div class="item-icon"><i class="fa-solid fa-plus"></i></div>
                                <div class="item-text">
                                    <strong>Criar Equipas</strong>
                                    <span>Adiciona novos talentos.</span>
                                </div>
                            </a>
                        </div>
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
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Sobre</a>
                </li>
            </ul>

            <div class="nav-actions">
                @auth
                    <a href="/profile" class="user-profile">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @else
                    <a href="/login" class="btn-login">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="content">
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; 2026 Zanth Gaming. criado por AnthonyM. Todos os direitos reservados.</p>
    </footer>

</body>

</html>
