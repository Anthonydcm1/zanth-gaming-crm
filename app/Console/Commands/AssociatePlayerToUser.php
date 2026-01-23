<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Player;
use Illuminate\Console\Command;

class AssociatePlayerToUser extends Command
{
    protected $signature = 'user:associate-player {user_id} {player_id}';
    protected $description = 'Associar um jogador a um utilizador';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $playerId = $this->argument('player_id');

        $user = User::find($userId);
        $player = Player::find($playerId);

        if (!$user) {
            $this->error("Utilizador com ID {$userId} não encontrado!");
            return 1;
        }

        if (!$player) {
            $this->error("Jogador com ID {$playerId} não encontrado!");
            return 1;
        }

        $user->player_id = $playerId;
        $user->save();

        $this->info("✅ Jogador '{$player->nickname}' associado ao utilizador '{$user->name}' com sucesso!");
        return 0;
    }
}
