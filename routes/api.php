<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\UpdateGame;
use App\Models\GameRoom;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Route::group([
    "middleware" => "auth:api"
], function () {
    Route::post('/find-room', function (Request $request) {
        $user = User::create(['name' => 'teste']);
        $token = $user->createToken('token')->accessToken;
        $roomId = GameRoom::latest()->value('id');

        if (!$roomId) {
            $room = GameRoom::create();
            $roomId = $room->id;
        }

        UpdateGame::dispatch($roomId);

        return response()->json(['room_id' => $roomId, 'token' => $token]);
    });

    Route::post('/guard/auth/broadcasting', function (Request $request) {
        return Broadcast::auth($request);
    });
});
