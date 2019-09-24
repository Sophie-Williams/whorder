<?php

namespace App\Actors;

use App\Actors\Actor;
use App\Constants\Keywords;
use App\Factories\QuestionFactory;

class PlayKeywordActor extends Actor
{

    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return $gamer->game == null && Keywords::START == trim(strtolower($message));
    }

     /**
     * Converse
     * @return string
     */
    public function talk()
    {
        parent::talk();

        return $this->processConvo(QuestionFactory::make()->generate());
    }

    /**
     * Process Conversation
     */
    private function processConvo($questionAnswer)
    {
        $question = join("\n", $questionAnswer["stripedQuestion"]);

        $this->gamer->game()->updateOrCreate(['is_answered' => false],[
            "question" => $question,
            "answer" => $questionAnswer["answerable"]
        ]);

        return $question;
    }
}