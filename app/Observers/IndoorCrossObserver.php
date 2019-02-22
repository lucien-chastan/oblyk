<?php

namespace App\Observers;

use App\IndoorCross;

class IndoorCrossObserver
{

    /**
     * @param IndoorCross $indoorCross
     */
    public function creating(IndoorCross $indoorCross) {
        $indoorCross->description = clean($indoorCross->description);
    }

    /**
     * Listen to the Gym updating event.
     *
     * @param IndoorCross $indoorCross
     * @return void
     */
    public function updating(IndoorCross $indoorCross)
    {
        $indoorCross->description = clean($indoorCross->description);
    }
}