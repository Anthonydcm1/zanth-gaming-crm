<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * Atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'name', 'nickname', 'game', 'photo', 'join_date', 'team_id',
        'role', 'nationality', 'status', 'rating',
        'steam_url', 'twitch_url', 'twitter_url', 'discord_tag'
    ];

    /**
     * Relação: Um jogador pertence a uma equipa.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Relação: Um jogador pode estar associado a uma conta de utilizador.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
