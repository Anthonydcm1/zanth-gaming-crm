@extends('layouts.main_layout')

@section('content')
    {{-- Secção Hero da Página Inicial --}}
    <div class="hero-section">
        <div class="hero-content">
            {{-- Título Principal e Slogan --}}
            <h1 class="gaming-font">Bem-vindo ao ZANTH</h1>
            <p class="hero-subtitle">O CRM ideal para gestão de equipas e jogadores.</p>

            {{-- Botões de Chamada para Ação (CTA) --}}
            <div class="hero-actions">
                <a href="/teams" class="btn-primary">Explorar Equipas</a>
                <a href="/players" class="btn-secondary">Ver Plantel</a>
            </div>
        </div>
    </div>
@endsection
