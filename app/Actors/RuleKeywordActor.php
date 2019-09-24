<?php

namespace App\Actors;

use App\Actors\Actor;
use App\Constants\Conversations;
use App\Constants\Keywords;

class RuleKeywordActor extends Actor
{

    /**
     * should talk
     */
    public static function shouldTalk($gamer, $message)
    {
        return Keywords::RULE == trim(strtolower($message));
    }

     /**
     * Converse
     * @return string
     */
    public function talk()
    {
        parent::talk();

        $conversation = Conversations::RULES;

        foreach ($this->buildConvo() as $key => $value) {
            $conversation = str_replace($key, $value, $conversation);
        }
        return $conversation;
    }

    /**
     * Build Convo
     */
    protected function buildConvo()
    {
        $start_key = Keywords::START;
        $rule_key = Keywords::RULE;
        $skip_key = Keywords::SKIP;
        $stop_key = Keywords::STOP;
        $pnts_key = Keywords::POINTS;
        $points_key = config("whorder.points");

        return compact(
            'start_key', 
            'rule_key', 
            'points_key',
            'skip_key',
            'stop_key',
            'pnts_key'
        );
    }
}