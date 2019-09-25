<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factories\WhatsappActorFactory;
use App\Factories\SlackActorFactory;
use Twilio\TwiML\MessagingResponse;

class WhorderController extends Controller
{
    /**
     * Create an Actor and Act
     */
    public function whatsapp()
    {
        $actor = WhatsappActorFactory::make();

        $messageResponse = new MessagingResponse;

        $messageResponse->message($actor->talk());

        return response($messageResponse, 200)->header(
            'Content-Type', 'text/xml'
        );
    }

    /**
     * Create an Actor and Act
     */
    public function slack()
    {
        if (request()->has("challenge")) {
            return response()->json([
                "challenge" => request()->get("challenge")
            ]);
        }
        $actor = SlackActorFactory::make();

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
