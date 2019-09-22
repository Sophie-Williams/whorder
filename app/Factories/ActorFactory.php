<?php

namespace App\Factories;

use App\Models\Gamer;
use Illuminate\Support\Facades\App as Application;
use Illuminate\Support\Facades\Request;

class ActorFactory
{

    /**
     * Actor
     * @var App\Contracts\Actor;
     */
    protected $actor;

    /**
     * Construct
     */
    public function __construct($phoneNumber = null, $message = null)
    {
        $gamer = $this->resolveGamer($phoneNumber);
        $this->actor = $this->resolveActor($gamer, $message);
    }
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

    /**
     * Resolve Gamer
     * @param $gamer
     * @return App\Models\Gamer
     */
    protected function resolveGamer($phoneNumber)
    {
        if (! $gamer  = Gamer::wherePhoneNumber($phoneNumber)->first()) {
            $gamer = new \App\Models\Gamer;
            $gamer->phone_number = $phoneNumber;
        }
        return $gamer;
    }

    /**
     * Resolve Actor
     * @param $gamer
     * @param $message
     * 
     * @return App\Contracts\Actor
     */
    protected function resolveActor($gamer, $message)
    {
        foreach ($this->getActors() as $actor) {

            if ($actor::shouldUse($gamer, $message)) 
                return new $actor($gamer,$message);
        }
        return new \App\Actors\SaluteActor($gamer, $message);
    }

    /**
     * Get available actors
     * @return array
     */
    protected function getActors()
    {
        return config("whorder.actors");
    }
}