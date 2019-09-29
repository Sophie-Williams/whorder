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
        $currentRound = $this->gamer->rounds;
        $currentPoints = $this->gamer->points;

        $gamePoints = $this->gamer->game->points;
        $gameAttempts = $this->gamer->game->attempts;

        $this->gamer->points = $currentPoints + $gamePoints;
        $this->gamer->rounds = $currentRound + 1;

        $this->gamer->save();
        $this->gamer->game()->delete();

        return $this->buildConvo($gamePoints, $gameAttempts);
    }

    /**
     * Return conversation after ending game
     */
    protected function buildConvo($gamePoints, $gameAttempts)
    {
        $convo = "Game Over! ";
        if ($gamePoints > 7 && $gamePoints < 15) {
            $convo .= "Well done {$this->gamer->first_name}! You played well. You got a total of $gamePoints points,
                    with $gameAttempts correct attempts. It's not too late for English lessons!";
        } elseif ($gamePoints > 15) {
            $convo .= "Brilliant Performance {$this->gamer->first_name}! You played well. You got a total of $gamePoints points,
                    with $gameAttempts correct attempts. You're a legend!";
        } else {
            $convo .= "Poor Performance {$this->gamer->first_name}! Your English teacher would be disappointed. 
                    You got a total of $gamePoints points, with $gameAttempts correct attempts. English Olodo!";
        }
        $start = Keywords::START;
        return $convo . "\n Say *{$start}*, to start another round";
    }


}