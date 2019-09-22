<?php

namespace App\Actors;

use App\Actors\Actor;

class SaluteActor extends Actor
{
    /**
     * should use
     */
    public static function shouldUse($gamer, $message)
    {
        return $gamer->game == null;
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