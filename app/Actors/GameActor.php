<?php

namespace App\Actors;

use App\Actors\Actor;
use App\Traits\ActorTrait;

class GameActor extends Actor
{
    use ActorTrait;
    
    protected $successMessages = [
        "You’re the most brilliant person I know. Well done.",
        "Good one mate. Bravo",
        "You're becoming a legend.",
        "You did it again. Amazing!",
        "You're making me cry. OMG!!!",
        "I'm impressed. You did it",
        "You're the bomb. You're doing great",
        "Way to go. You're a genius"
    ];

    protected $failureMessages = [
        "Hang in there. You're close.",
        "Don't give up. Very close.",
        "Keep pushing. Just a little more.",
        "Keep fighting! Almost there.",
        "Stay strong. Try one more time.",
        "Never give up. Maybe the next one would be it.",
        "Never say 'die'. So close!",
        "Come on! You can do it!",
    ];

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
        parent::talk();

        if ($this->checkAnswer()) {
            return $this->correctAnswerActivity();
        }
        return $this->wrongAnswerActivity();
    }

    /**
     * Check Answer
     */
    protected function checkAnswer()
    {
        return trim(strtolower($this->gamer->game->answer)) == trim(strtolower($this->message));
    }

    /**
     * Perfom if gamer answers correctly
     */
    protected function correctAnswerActivity()
    {
        $this->givePoints();
        return $this->successMessages[rand(0, count($this->successMessages) - 1)]
                . " You're on {$this->gamer->game->points} points" . "\n\n" . $this->nextQuestion();
    }

    /**
     * Give points to gamer
     */
    protected function givePoints()
    {
        $this->gamer->game->points = $this->gamer->game->points + config("whorder.points");
        $this->gamer->game->attempts = $this->gamer->game->attempts + 1;
        $this->gamer->push();
    }

    /**
     * Perfom if gamer answers wrongly
     */
    protected function wrongAnswerActivity()
    {
        $missedCount = $this->gamer->game->missed_count + 1;

        if ($missedCount >= config("whorder.missed_count")) {
            $convo = $this->failureMessages[rand(0, count($this->failureMessages) - 1)]
            . "\n\n" . $this->nextQuestion();  
        } else {
            $convo = $this->failureMessages[rand(0, count($this->failureMessages) - 1)];
            $this->gamer->game->missed_count = $missedCount;
        }
        $this->gamer->push();

        return $convo;
    }
}