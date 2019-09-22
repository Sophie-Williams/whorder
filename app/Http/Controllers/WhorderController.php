<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factories\ActorFactory;
use Twilio\TwiML\MessagingResponse;

class WhorderController extends Controller
{
    /**
     * Create an Actor and Act
     */
    public function __invoke()
    {
        $actor = ActorFactory::make();

        return $this->makeResponse($actor->talk());
    }

    /**
     * Make Twitl Response
     */
    protected function makeResponse(string $reply)
    {
        $messageResponse = new MessagingResponse;

        $messageResponse->message($reply);

        return response($messageResponse, 200)->header(
            'Content-Type', 'text/xml'
        );
    }
}
