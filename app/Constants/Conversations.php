<?php

namespace App\Constants;

class Conversations
{
    const SALUTE = "Hey name_key! extra_greet_key If you're familiar with the rules, just say *start_key* to begin, else say *rule_key*. Let's play game_key";

    const RULES = "I'll give you some words with missing letters. Put together
                    each missing letter to form a new word. Relpy with the new word to earn
                    points_key points. You have round_key questions to answer with missed_key
                    attempts per question. \nKeywords: \n1. Say *start_key* to start the game\n
                    2. Say *skip_key* to skip a question\n3. Say *stop_key* to stop the game\n
                    4. Say *name_key* to tell me your name\n
                    5. Say *pnts_key* to see your total points\n6. Say *rule_key* to see this rules again";

    const POINTS = "You have points_key overall points! Answer more questions correctly to increase your points.";

    const SKIP = "Alright player! I heard you. On to the next one.";

    const NAME = "Ok, so tell me, what shall I call you?";
}