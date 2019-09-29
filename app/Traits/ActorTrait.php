<?php

namespace App\Traits;

use App\Actors\PlayKeywordActor;
use App\Actors\StopKeywordActor;

trait ActorTrait
{
    /**
     * Generate next question
     */
    protected function nextQuestion()
    {
        $questionAttempts = $this->gamer->game->question_attempts + 1;

        if ($questionAttempts >= config("whorder.round")) {
            return $this->call(StopKeywordActor::class);
        }

        $this->gamer->game->question_attempts = $questionAttempts;
        $this->gamer->push();
        return $this->call(PlayKeywordActor::class);
    }
}