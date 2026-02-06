<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Atributos que podem ser preenchidos em massa.
     */
    protected $fillable = ['name', 'logo'];

    /**
     * Relação: Uma equipa tem muitos jogadores.
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
