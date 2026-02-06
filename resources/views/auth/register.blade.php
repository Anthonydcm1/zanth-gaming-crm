<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registo - Zanth Gaming CRM</title>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Orbitron:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="auth-page">
    <div class="register-card">
        {{-- Cabeçalho do Registo --}}
        <div class="register-header">
            <div class="logo-text"><span class="logo-z">Z</span>ANTH</div>
            <h1 class="gaming-font" style="font-size: 1.2rem; color: var(--text-muted);">Criar Nova Conta</h1>
        </div>

        {{-- Exibição de Erros de Validação --}}
        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulário de Registo de Utilizador e Jogador --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nome e Nickname --}}
            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">Nome Completo</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="form-input" placeholder="João Silva">
                </div>
                <div class="form-group">
                    <label for="nickname" class="form-label">Nickname (IGN)</label>
                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required
                        class="form-input" placeholder="ZanthPlayer">
                </div>
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email" class="form-label">Endereço de Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="form-input" placeholder="email@exemplo.com">
            </div>

            {{-- Jogo Principal --}}
            <div class="form-group">
                <label for="game" class="form-label">Jogo Principal</label>
                <input type="text" id="game" name="game" value="{{ old('game') }}" required
                    class="form-input" placeholder="Ex: Fortnite, Valorant, CS2">
            </div>

            {{-- Função e Nacionalidade --}}
            <div class="form-row">
                <div class="form-group">
                    <label for="role" class="form-label">Posição / Função</label>
                    <input type="text" id="role" name="role" value="{{ old('role') }}" class="form-input"
                        placeholder="Ex: AWPer, IGL, Mid Lane">
                </div>
                <div class="form-group">
                    <label for="nationality" class="form-label">Nacionalidade</label>
                    <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}"
                        class="form-input" placeholder="Ex: Portugal, Brasil">
                </div>
            </div>

            {{-- Seleção de Equipa --}}
            <div class="form-group">
                <label for="team_id" class="form-label">Seleccionar Equipa</label>
                <select name="team_id" id="team_id" class="form-select" required>
                    <option value="" disabled selected>Escolhe a tua equipa...</option>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Palavra-passe e Confirmação --}}
            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Palavra-passe</label>
                    <input type="password" id="password" name="password" required class="form-input"
                        placeholder="********">
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="form-input" placeholder="********">
                </div>
            </div>

            {{-- Botão de Submissão --}}
            <button type="submit" class="btn-register">
                Criar Conta <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
            </button>
        </form>

        {{-- Link para Login --}}
        <p class="login-link">
            Já tens uma conta? <a href="{{ route('login') }}">Faz Login</a>
        </p>
    </div>
</body>

</html>
