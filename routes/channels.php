<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('Game.Room.{id}', function ($user, $id) {
    return true;
}, ['guards' => ['api']]);
