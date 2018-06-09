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
        try {
            if(file_exists(storage_path('app/public/gyms/schemes/scheme-' . $room->id . '.png'))) unlink(storage_path('app/public/gyms/scheme/scheme-' . $room->id . '.png'));
            if(file_exists(storage_path('app/public/gyms/schemes/100/scheme-' . $room->id . '.png'))) unlink(storage_path('app/public/gyms/scheme/100/scheme-' . $room->id . '.png'));
        } catch (\Exception $e) {}
    }
}