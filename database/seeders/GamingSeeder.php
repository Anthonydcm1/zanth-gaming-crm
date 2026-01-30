<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GamingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     //atualizar a base de dados
     //php artisan migrate:fresh --seed

        // 1. Criar Equipas
        $elites = Team::create([
            'name' => 'Elites',
            'logo' => '/img/elites_logo_placeholder.png'
        ]);

        $zanthPro = Team::create([
            'name' => 'Zanth Pro',
            'logo' => '/img/zanth_logo_placeholder.png'
        ]);

        $cesae = Team::create([
            'name' => 'Cesae',
            'logo' => '/img/cesae_logo.jpg'
        ]);

        // 2. Criar Fichas de Jogo (Players)

        $playerAdmin = Player::create([
            'name' => 'Anthony Mendoza',
            'nickname' => 'Toniic1',
            'game' => 'Fortnite',
            'role' => 'Support',
            'nationality' => 'Portugal',
            'photo' => '/img/default_avatar.png',
            'join_date' => now(),
            'status' => 'Ativo',
            'team_id' => $zanthPro->id
        ]);

        $playerSara = Player::create([
            'name' => 'Sara Monteiro',
            'nickname' => 'Sarmon',
            'game' => 'Valorant',
            'role' => 'IGL',
            'nationality' => 'Portugal',
            'photo' => '/img/default_avatar.png',
            'join_date' => now(),
            'status' => 'Ativo',
            'team_id' => $cesae->id
        ]);

        // 3. Criar Utilizadores vinculados aos Players

        // Admin
        User::create([
            'name' => 'Anthony Mendoza',
            'email' => 'admin@zanth.com',
            'password' => Hash::make('admin@zanth.com'),
            'user_type' => 1,
            'player_id' => $playerAdmin->id
        ]);

        // Utilizadores normais
        User::create([
            'name' => 'Sara Monteiro',
            'email' => 'saram@exemplo.com',
            'password' => Hash::make('saram@exemplo.com'),
            'user_type' => 0,
            'player_id' => $playerSara->id
        ]);
    }
}
