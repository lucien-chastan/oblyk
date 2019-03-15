<?php

namespace App\Observers;

use App\GymRoute;
use App\GymSector;
use Carbon\Carbon;

class GymSectorObserver
{

    /**
     * @param GymSector $sector
     */
    public function creating(GymSector $sector)
    {
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

    /**
     * Listen to the Cross deleting event.
     *
     * @param GymSector $gymSector
     * @return void
     */
    public function deleting(GymSector $gymSector)
    {
        $routes = GymRoute::where('sector_id', $gymSector->id)->get();

        // Delete all route in this sector
        foreach ($routes as $route) {
            $route->delete();
        }

        // Delete sector picture
        if ($gymSector->hasPicture()) {
            if (file_exists(storage_path('app/public/gyms/sectors/1300/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/1300/sector-' . $gymSector->id . '.jpg'));
            if (file_exists(storage_path('app/public/gyms/sectors/500/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/500/sector-' . $gymSector->id . '.jpg'));
            if (file_exists(storage_path('app/public/gyms/sectors/200/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/200/sector-' . $gymSector->id . '.jpg'));
            if (file_exists(storage_path('app/public/gyms/sectors/50/sector-' . $gymSector->id . '.jpg'))) unlink(storage_path('app/public/gyms/sectors/50/sector-' . $gymSector->id . '.jpg'));
        }
    }
}