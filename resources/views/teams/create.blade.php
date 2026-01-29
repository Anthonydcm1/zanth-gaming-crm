@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <div class="form-card">
            <h2 class="gaming-font">Inserir Nova Equipa</h2>
            <p class="text-muted">Cria uma nova lineup para a organização ZANTH.</p>

            <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data" class="gaming-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nome da Equipa</label>
                    <input type="text" name="name" id="name" required placeholder="Ex: Zanth Academy">
                </div>

                <div class="form-group">
                    <label for="logo">Logótipo da Equipa</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="logo" id="logo" class="file-input">
                        <span class="file-label"><i class="fa-solid fa-upload"></i> Escolher Imagem</span>
                    </div>
                    <small class="text-muted">Formatos: JPG, PNG, SVG (Máx: 2MB)</small>
                </div>

                <div class="form-actions">
                    <a href="{{ route('teams.index') }}" class="btn-secondary">Cancelar</a>
                    <button type="submit" class="btn-primary">Criar Equipa</button>
                </div>
            </form>
        </div>
    </div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endpush
@endsection
