<?php

namespace App\Actors;

use App\Actors\Actor;

class SaluteActor extends Actor
{
    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return $gamer->game == null;
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