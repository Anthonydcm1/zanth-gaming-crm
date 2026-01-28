<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255'],
            'game' => ['required', 'string', 'max:255'],
            'team_id' => ['required', 'exists:teams,id'],
            'role' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        // Criar a ficha de jogador (Player)
        $player = Player::create([
            'name' => $input['name'],
            'nickname' => $input['nickname'],
            'game' => $input['game'],
            'team_id' => $input['team_id'],
            'role' => $input['role'] ?? null,
            'nationality' => $input['nationality'] ?? null,
            'photo' => '/img/default_avatar.png', // Imagem padrão
            'join_date' => now(),
            'status' => 'Ativo',
        ]);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'player_id' => $player->id,
            'user_type' => 0, // Utilizador normal por defeito
        ]);
    }
}
