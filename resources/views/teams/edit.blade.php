@extends('layouts.main_layout')

@section('content')
    <div class="container">
        {{-- Card de Formulário para Edição de Equipa --}}
        <div class="form-card">
            <h2 class="gaming-font">Editar Equipa: {{ $team->name }}</h2>
            <p class="text-muted">Atualiza os dados da lineup ZANTH.</p>

            {{-- Formulário com método PUT e suporte para upload --}}
            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data"
                class="gaming-form">
                @csrf
                @method('PUT')

                {{-- Campo Nome --}}
                <div class="form-group">
                    <label for="name">Nome da Equipa</label>
                    <input type="text" name="name" id="name" value="{{ $team->name }}" required>
                </div>

                {{-- Visualização do Logo Atual e Upload de Novo --}}
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

                {{-- Botões de Ação --}}
                <div class="form-actions">
                    <a href="{{ route('teams.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">Guardar Alterações</button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        {{-- CSS específico para formulários --}}
        <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    @endpush
@endsection
