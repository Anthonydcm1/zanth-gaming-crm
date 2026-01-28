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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: var(--bg-dark);
            background-image: radial-gradient(circle at center, rgba(230, 57, 70, 0.05) 0%, transparent 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .register-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-premium);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .logo-z {
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .form-input,
        .form-select {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 15px;
            color: var(--text-main);
            font-family: inherit;
            transition: var(--transition);
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 2px rgba(230, 57, 70, 0.2);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-register {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            cursor: pointer;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
        }

        .error-message {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 0.9rem;
            border-left: 4px solid #e74c3c;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .register-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="register-card">
        <div class="register-header">
            <div class="logo-text"><span class="logo-z">Z</span>ANTH</div>
            <h1 class="gaming-font" style="font-size: 1.2rem; color: var(--text-muted);">Criar Nova Conta</h1>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

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

            <div class="form-group">
                <label for="email" class="form-label">Endereço de Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="form-input" placeholder="email@exemplo.com">
            </div>

            <div class="form-group">
                <label for="game" class="form-label">Jogo Principal</label>
                <input type="text" id="game" name="game" value="{{ old('game') }}" required
                    class="form-input" placeholder="Ex: Fortnite, Valorant, CS2">
            </div>

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

            <button type="submit" class="btn-register">
                Criar Conta <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
            </button>
        </form>

        <p class="login-link">
            Já tens uma conta? <a href="{{ route('login') }}">Faz Login</a>
        </p>
    </div>
</body>

</html>
