<?php

namespace App\Observers;

use App\GymSector;

class GymSectorObserver
{

    /**
     * @param GymSector $sector
     */
    public function creating(GymSector $sector) {
        $sector->label = strip_tags($sector->label);
        $sector->group_sector = strip_tags($sector->group_sector);
        $sector->height = strip_tags($sector->height);
        $sector->description = clean($sector->description);
    }

    /**
     * Listen to the Gym updating event.
     *
     * @param GymSector $sector
     * @return void
     */
    public function updating(GymSector $sector)
    {
        $sector->label = strip_tags($sector->label);
        $sector->group_sector = strip_tags($sector->group_sector);
        $sector->height = strip_tags($sector->height);
        $sector->description = clean($sector->description);
    }
}