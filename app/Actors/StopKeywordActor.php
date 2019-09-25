<?php

namespace App\Actors;

use App\Actors\Actor;
use App\Constants\Conversations;
use App\Constants\Keywords;

class StopKeywordActor extends Actor
{

    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return (bool)$gamer->game && Keywords::STOP == trim(strtolower($message));
    }

     /**
     * Converse
     * @return string
     */
    public function talk()
    {
        parent::talk();

        return $this->saveGame();
    }

    /**
     * Save the game data for gamer
     */
    protected function saveGame()
    {
        $currentAttempts = $this->gamer->attempts;
        $currentPoints = $this->gamer->points;

        $gamePoints = $this->gamer->game->points;
        $gameAttempts = $this->gamer->game->attempts;

        $this->gamer->attempts = $currentAttempts + $gameAttempts;
        $this->gamer->points = $currentPoints + $gamePoints;

        $this->gamer->save();
        $this->gamer->game()->delete();

        return $this->buildConvo($gamePoints, $gameAttempts);
    }

    /**
     * Return conversation after ending game
     */
    protected function buildConvo($gamePoints, $gameAttempts)
    {
        if ($gamePoints > 10 && $gamePoints < 50) {
            $convo = "Well done! You played well. You got a total of $gamePoints points,
                    with $gameAttempts attempts. It's not too late for English lessons!";
        } elseif ($gamePoints > 50) {
            $convo = "Brilliant Performance! You played well. You got a total of $gamePoints points,
                    with $gameAttempts attempts. You're a legend!";
        } else {
            $convo = "Poor Performance! Your English teacher would be dissapointed. 
                    You got a total of $gamePoints points, with $gameAttempts attempts. English Olodo!";
        }
        return $convo;
    }


}