<?php

namespace App\Actors;

use App\Actors\Actor;

class KeyWordActor extends Actor
{
    /**
     * Keywords
     */
    const KEY_WORDS = [
        "rule", "play", "stop", "pnts", "skip"
    ];

    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return in_array(trim(strtolower($message)), static::KEY_WORDS);
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