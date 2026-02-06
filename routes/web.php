<?php

use Illuminate\Support\Facades\Route;

// Página Inicial
Route::get('/', function () {
    return view('utils.home');
});

// Listagem de Equipas (Público)
Route::get('/teams', [\App\Http\Controllers\TeamController::class, 'index'])->name('teams.index');

// Rotas protegidas para Administradores
Route::middleware(['auth', 'admin'])->group(function () {
    // Gestão de Equipas
    Route::get('/teams/create', [\App\Http\Controllers\TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [\App\Http\Controllers\TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{team}/edit', [\App\Http\Controllers\TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{team}', [\App\Http\Controllers\TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [\App\Http\Controllers\TeamController::class, 'destroy'])->name('teams.destroy');

    // Gestão de Utilizadores
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/toggle-admin', [\App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('admin.users.toggle');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Jogadores de uma Equipa específica
Route::get('/teams/{team}/players', function (\App\Models\Team $team) {
    $players = $team->players;
    return view('players.team_players', compact('team', 'players'));
})->name('teams.players');

// Listagem de Jogadores (Público)
Route::get('/players', [\App\Http\Controllers\PlayerController::class, 'index'])->name('players.index');

// Gestão de Jogadores (Apenas Admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/players/create', [\App\Http\Controllers\PlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [\App\Http\Controllers\PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}/edit', [\App\Http\Controllers\PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [\App\Http\Controllers\PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [\App\Http\Controllers\PlayerController::class, 'destroy'])->name('players.destroy');
});

// Dashboard do Utilizador
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Perfil do Utilizador
Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');

Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('profile.edit');

Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

// Página "Sobre"
Route::get('/about', function () {
    return view('utils.about');
})->name('about');
