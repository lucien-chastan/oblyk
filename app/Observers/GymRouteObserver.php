<?php

namespace App\Observers;

use App\GymRoute;

class GymRouteObserver
{

    /**
     * @param GymRoute $route
     */
    public function creating(GymRoute $route) {
        $route->label = strip_tags($route->label);
        $route->reference = strip_tags($route->reference);
        $route->height = strip_tags($route->height);
        $route->opener = strip_tags($route->opener);
        $route->description = clean($route->description);
    }

    /**
     * Listen to the Gym updating event.
     *
     * @param GymRoute $route
     * @return void
     */
    public function updating(GymRoute $route)
    {
        $route->label = strip_tags($route->label);
        $route->reference = strip_tags($route->reference);
        $route->height = strip_tags($route->height);
        $route->opener = strip_tags($route->opener);
        $route->description = clean($route->description);
    }
}