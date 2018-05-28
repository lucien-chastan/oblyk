<?php

namespace App\Observers;

use App\RouteSection;
use App\Version;

class RouteSectionObserver
{

    /**
     * Listen to the Route Section updating event.
     *
     * @param RouteSection $routeSection
     * @return void
     */
    public function updating(RouteSection $routeSection)
    {
        $version = new Version();
        $version->saveVersion(RouteSection::find($routeSection->id), $routeSection, 'App\RouteSection');
    }

    /**
     * Listen to the RouteSection deleting event.
     *
     * @param RouteSection $routeSection
     * @return void
     */
    public function deleting(RouteSection $routeSection) {
        try {
            Version::where([
                ['versionnable_id', '=', $routeSection->id],
                ['versionnable_type', '=', 'App\RouteSection']
            ])->delete();
        } catch (\Exception $e) {}
    }
}