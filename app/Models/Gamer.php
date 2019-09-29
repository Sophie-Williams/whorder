<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Gamer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone_number',
        'points', 'rounds'
    ];

    /**
     * Gamer's Game
     */
    public function game()
    {
        return $this->hasOne(Game::class);
    }

    /**
     * Gamer's Conversation
     */
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
}
