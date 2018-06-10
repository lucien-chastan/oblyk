<?php

namespace App\Observers;

use App\GymRoom;

class RoomObserver
{
    /**
     * Listen to the Route deleting event.
     *
     * @param GymRoom $room
     * @return void
     */
    public function deleting(GymRoom $room) {
        //
    }
}