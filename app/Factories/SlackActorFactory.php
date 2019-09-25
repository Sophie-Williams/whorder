<?php

namespace App\Factories;

use App\Models\Gamer;
use Illuminate\Support\Facades\App as Application;
use Illuminate\Support\Facades\Request;

class SlackActorFactory extends ActorFactory
{
    /**
     * Make Actor
     */
    public static function make()
    {
        $self = new static(
            Request::get("From"), 
            Request::get("Body"));

        return $self->actor;
    }

}