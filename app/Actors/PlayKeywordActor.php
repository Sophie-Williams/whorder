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

        if ($this->gamer->first_name == null) {
            return $this->processName();
        }

        return $this->processConvo(QuestionFactory::make()->generate());
    }

    /**
     * Process Conversation
     */
    private function processConvo($questionAnswer)
    {
        $question = join("\n", $questionAnswer["stripedQuestion"]);

        $this->gamer->game()->updateOrCreate(['gamer_id' => $this->gamer->id],[
            "question" => $question,
            "answer" => $questionAnswer["answerable"],
            "missed_count" => 0
        ]);
        $questionNumber = ($this->gamer->game->question_attempts ?? 0) + 1;
        return "\nQuestion {$questionNumber}:\n" . $question;
    }

    /**
     * Process Name
     */
    private function processName()
    {
        return $this->call(NameKeywordActor::class, static::class);
    }
}