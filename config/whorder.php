<?php

/**
 * Return Whorder Configs
 */
return [

    /**
     * Registered Actors
     */
    "actors" => [
        App\Actors\RuleKeywordActor::class,
        App\Actors\PlayKeywordActor::class,
        App\Actors\GameActor::class,
        App\Actors\SaluteActor::class,
    ],

    /**
     * Correct points to award for each correct question
     */
    "points" => 3
];