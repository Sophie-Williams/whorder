<?php

namespace App\Http\Controllers;

use App\Models\Gamer;
use App\Constants\Keywords;
use Illuminate\Http\Request;
use App\Actors\StopKeywordActor;
use Twilio\TwiML\MessagingResponse;
use App\Factories\SlackActorFactory;
use App\Factories\WhatsappActorFactory;

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
     * Stop all Games
     */
    public function stopAllGames()
    {
        $data = Gamer::whereHas("game")->get()->map(function($gamer) {
            $stopActor = new StopKeywordActor($gamer, Keywords::STOP);
            return $stopActor->talk();
        });

        return response()->json(["message" => "all games stopped successfully", "data" => $data]);
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
