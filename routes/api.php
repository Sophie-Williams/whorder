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

Route::get('/whatsapp/whorder/stop-all-games', 'WhorderController@stopAllGames');

Route::post('/slack/whorder', 'WhorderController@slack');

Route::post('sendmail', function () {
    
    App\Email::create(request()->all());
    return response()->json(["message" => "success"]);
})->middleware('cors');
