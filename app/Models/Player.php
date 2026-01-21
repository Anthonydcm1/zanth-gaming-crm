<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'photo', 'join_date', 'team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
