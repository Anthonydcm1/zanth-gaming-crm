@extends('layouts.main_layout')

@section('content')
    <div class="about-container">
        {{-- Cabeçalho da Secção Sobre --}}
        <div class="about-header section-fade">
            <h1 class="gaming-font title-reveal">Sobre Nós</h1>
            <div class="title-underline"></div>
        </div>

        {{-- Conteúdo Informativo em Cards --}}
        <div class="about-content">
            {{-- Card Missão --}}
            <div class="about-card section-fade" style="animation-delay: 0.2s">
                <p>
                    A <strong>Zanth</strong> é a plataforma que simplifica a gestão de equipas, jogadores e competições.
                    Criámos um espaço onde treinadores, atletas e organizações podem controlar tudo num só lugar — desde
                    estatísticas e calendários até performance individual e resultados em tempo real.
                </p>
            </div>

            {{-- Card Objetivo --}}
            <div class="about-card section-fade" style="animation-delay: 0.4s">
                <p>
                    O nosso objetivo é claro: tornar a gestão desportiva mais rápida, intuitiva e profissional.
                    Acreditamos que cada equipa merece ferramentas modernas que elevem o seu desempenho dentro e fora do
                    jogo.
                </p>
            </div>

            {{-- Card de Destaque Final --}}
            <div class="about-card highlight section-fade" style="animation-delay: 0.6s">
                <p>
                    Com a Zanth, transformas dados em decisões, organização em resultados e equipas em verdadeiras potências
                    competitivas.
                    <strong>Estamos aqui para impulsionar o teu jogo.</strong>
                </p>
            </div>
        </div>
    </div>
@endsection
