<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar Utilizadores
        \App\Models\User::create([
            'name' => 'Admin Zanth',
            'email' => 'admin@zanth.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'user_type' => 1
        ]);

        \App\Models\User::create([
            'name' => 'Gaming User',
            'email' => 'user@zanth.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'user_type' => 0
        ]);

        $zanth = \App\Models\Team::create([
            'name' => 'Zanth Elite',
            'logo' => 'https://api.dicebear.com/7.x/identicon/svg?seed=Zanth'
        ]);

        $crimson = \App\Models\Team::create([
            'name' => 'Crimson Squad',
            'logo' => 'https://api.dicebear.com/7.x/identicon/svg?seed=Crimson'
        ]);

        \App\Models\Player::create([
            'name' => 'Nexus',
            'photo' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Nexus',
            'join_date' => '2025-01-01',
            'team_id' => $zanth->id
        ]);

        \App\Models\Player::create([
            'name' => 'Viper',
            'photo' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Viper',
            'join_date' => '2025-02-15',
            'team_id' => $zanth->id
        ]);

        \App\Models\Player::create([
            'name' => 'Blaze',
            'photo' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=Blaze',
            'join_date' => '2024-11-20',
            'team_id' => $crimson->id
        ]);
    }
}
