<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('nickname')->after('name'); // Nome de jogo (IGN)
            $table->string('role')->nullable()->after('nickname'); // Posição/função
            $table->string('nationality')->nullable()->after('role'); // País
            $table->enum('status', ['Ativo', 'Reserva', 'Inativo'])->default('Ativo')->after('nationality');
            $table->string('rating')->nullable()->after('status'); // Nível/rank
            $table->string('steam_url')->nullable()->after('rating');
            $table->string('twitch_url')->nullable()->after('steam_url');
            $table->string('twitter_url')->nullable()->after('twitch_url');
            $table->string('discord_tag')->nullable()->after('twitter_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn([
                'nickname', 'role', 'nationality', 'status', 'rating',
                'steam_url', 'twitch_url', 'twitter_url', 'discord_tag'
            ]);
        });
    }
};
