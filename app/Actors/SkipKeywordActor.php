<?php

namespace App\Actors;

use App\Actors\Actor;
use App\Traits\ActorTrait;
use App\Constants\Keywords;
use App\Constants\Conversations;

class SkipKeywordActor extends Actor
{
    use ActorTrait;

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

        return $conversation . "\n" . $this->nextQuestion();
    }
}