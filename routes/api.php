<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/whatsapp/whorder', 'WhorderController@whatsapp');

Route::post('/slack/whorder', 'WhorderController@slack');

Route::post('sendmail', function () {
    sendMail();
    return response()->json(["message" => "success"]);
})->middleware('cors');

function sendMail()
{
    $name = request()->name;
    $sender_email = request()->sender_email;
    $message = request()->message;

    \Mail::raw($message, function($mail) use ($name, $sender_email){
        $mail->to("nwogugabriel@gmail.com");
        $mail->subject("{$name}, {$sender_email}");
    });
}
