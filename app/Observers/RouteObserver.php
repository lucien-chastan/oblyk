<?php

namespace App\Observers;

use App\Route;
use App\Version;

class RouteObserver
{

    /**
     * @param Route $route
     */
    public function creating(Route $route) {
        $route->label = strip_tags($route->label);
        $route->opener = strip_tags($route->opener);
    }

    /**
     * Listen to the Route updating event.
     *
     * @param Route $route
     * @return void
     */
    public function updating(Route $route)
    {
        $route->label = strip_tags($route->label);
        $route->opener = strip_tags($route->opener);

        $version = new Version();
        $version->saveVersion(Route::find($route->id), $route, 'App\Route');
    }

    /**
     * Listen to the Route deleting event.
     *
     * @param Route $route
     * @return void
     */
    public function deleting(Route $route) {
        try {
            Version::where([
                ['versionnable_id', '=', $route->id],
                ['versionnable_type', '=', 'App\Route']
            ])->delete();
        } catch (\Exception $e) {}
    }
}