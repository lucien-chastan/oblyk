<?php

namespace App\Observers;


use App\Parking;

class ParkingObserver
{

    /**
     * @param Parking $parking
     */
    public function creating(Parking $parking) {
        $parking->description = strip_tags($parking->description);
    }

    /**
     * @param Parking $parking
     */
    public function updating(Parking $parking) {
        $parking->description = strip_tags($parking->description);
    }

}