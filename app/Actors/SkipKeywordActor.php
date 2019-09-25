<?php

namespace App\Actors;

use App\Actors\Actor;
use App\Constants\Conversations;
use App\Constants\Keywords;

class SkipKeywordActor extends Actor
{

    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return (bool)$gamer->game && Keywords::SKIP == trim(strtolower($message));
    }

     /**
     * Converse
     * @return string
     */
    public function talk()
    {
        parent::talk();

        $conversation = Conversations::SKIP;

        return $conversation . "\n" . $this->call(PlayKeywordActor::class);
    }
}