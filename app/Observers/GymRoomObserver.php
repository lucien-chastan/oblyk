<?php

namespace App\Observers;

use App\GymRoom;

class GymRoomObserver
{

    /**
     * @param GymRoom $room
     */
    public function creating(GymRoom $room) {
        $room->label = strip_tags($room->label);
        $room->description = clean($room->description);
    }

    /**
     * Listen to the Gym updating event.
     *
     * @param GymRoom $room
     * @return void
     */
    public function updating(GymRoom $room)
    {
        $room->label = strip_tags($room->label);
        $room->description = clean($room->description);
    }
}