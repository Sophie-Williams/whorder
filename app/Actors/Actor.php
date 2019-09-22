<?php

namespace App\Actors;

use App\Contracts\Actor as ActorContract;

abstract class Actor implements ActorContract
{
    /**
     * @var Gamer
     */
    protected $gamer;

    /**
     * @var string
     */
    protected $message;

    public function __construct($gamer, $message)
    {
        $this->gamer = $gamer;
        $this->message = $message;
    }
}