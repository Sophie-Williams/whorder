<?php

namespace App\Actors;

use App\Actors\Actor;

class GameActor extends Actor
{
    /**
     * should use
     */
    public static function shouldUse($gamer, $message)
    {
        return (bool)$gamer->game;
    }

     /**
     * Converse
     * @return string
     */
    public function converse()
    {
        return "Hello";
    }
}