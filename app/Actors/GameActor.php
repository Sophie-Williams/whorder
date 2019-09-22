<?php

namespace App\Actors;

use App\Actors\Actor;

class GameActor extends Actor
{
    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return (bool)$gamer->game;
    }

     /**
     * Converse
     * @return string
     */
    public function talk()
    {
        return "Hello";
    }
}