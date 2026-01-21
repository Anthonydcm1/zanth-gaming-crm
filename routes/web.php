<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('utils.home');
});

Route::get('/teams', [\App\Http\Controllers\TeamController::class, 'index'])->name('teams.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/teams/create', [\App\Http\Controllers\TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [\App\Http\Controllers\TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{team}/edit', [\App\Http\Controllers\TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{team}', [\App\Http\Controllers\TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [\App\Http\Controllers\TeamController::class, 'destroy'])->name('teams.destroy');
});

Route::get('/teams/{team}/players', function (\App\Models\Team $team) {
    $players = $team->players;
    return view('players.team_players', compact('team', 'players'));
})->name('teams.players');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


