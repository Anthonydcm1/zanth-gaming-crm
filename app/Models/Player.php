<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 'nickname', 'photo', 'join_date', 'team_id',
        'role', 'nationality', 'status', 'rating',
        'steam_url', 'twitch_url', 'twitter_url', 'discord_tag'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
