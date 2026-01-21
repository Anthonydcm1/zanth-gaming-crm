@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="form-card">
            <h2 class="gaming-font">Editar Equipa: {{ $team->name }}</h2>
            <p class="text-muted">Atualiza os dados da lineup ZANTH.</p>

            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data"
                class="gaming-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nome da Equipa</label>
                    <input type="text" name="name" id="name" value="{{ $team->name }}" required>
                </div>

                <div class="form-group">
                    <label>Logo Atual</label>
                    <img src="{{ $team->logo }}" alt="Logo"
                        style="width: 80px; height: 80px; border-radius: 8px; margin-bottom: 10px; background: var(--bg-dark);">

                    <label for="logo">Novo Logótipo (Opcional)</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="logo" id="logo" class="file-input">
                        <span class="file-label"><i class="fa-solid fa-upload"></i> Substituir Imagem</span>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('teams.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">Guardar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .container {
            max-width: 600px;
            margin: 40px auto;
        }

        .form-card {
            background: var(--bg-surface);
            padding: 40px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-premium);
        }

        .gaming-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-group input[type="text"] {
            background: var(--bg-dark);
            border: 1px solid var(--border);
            padding: 12px;
            border-radius: 8px;
            color: white;
        }

        .file-input-wrapper {
            position: relative;
            background: var(--bg-dark);
            border: 1px dashed var(--border);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-label {
            color: var(--primary);
            font-weight: 600;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            flex: 1;
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
        }
    </style>
@endsection
