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
        App\Actors\NameKeywordActor::class,
        App\Actors\NameActor::class,
        App\Actors\PointsKeywordActor::class,
        App\Actors\SkipKeywordActor::class,
        App\Actors\StopKeywordActor::class,
        App\Actors\PlayKeywordActor::class,
        App\Actors\GameActor::class,
        App\Actors\SaluteActor::class,
    ],

    /**
     * Correct points to award for each correct question
     */
    "points" => 3,

    /**
     * Questions per round
     */
    "round" => 7,

    /**
     * Allowed Misses per question
     */
    "missed_count" => 3,
];