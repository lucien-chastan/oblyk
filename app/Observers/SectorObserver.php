<?php

namespace App\Observers;

use App\Description;
use App\GapGrade;
use App\Orientation;
use App\Photo;
use App\Route;
use App\Season;
use App\Sector;
use App\Version;

class SectorObserver
{

    /**
     * @param Sector $sector
     */
    public function creating(Sector $sector) {
        $sector->label = strip_tags($sector->label);
    }

    /**
     * Listen to the Sector updating event.
     *
     * @param Sector $sector
     * @return void
     */
    public function updating(Sector $sector)
    {
        $version = new Version();
        $version->saveVersion(Sector::find($sector->id), $sector, 'App\Sector');
    }

    /**
     * Listen to the Sector deleting event.
     *
     * @param  Sector $sector
     * @return void
     * @throws \Exception
     */
    public function deleting(Sector $sector)
    {

        //Suppression de l'orientation
        $orientation = Orientation::where([['orientable_id', $sector->id], ['orientable_type', 'App\Sector']])->first();
        if (isset($orientation)) $orientation->delete();

        //Suppression des seasons
        $season = Season::where([['seasontable_id', $sector->id], ['seasontable_type', 'App\Sector']])->first();
        if (isset($season)) $season->delete();

        //Suppression des descriptions
        $descriptions = Description::where([['descriptive_id', $sector->id], ['descriptive_type', 'App\Sector']])->get();
        foreach ($descriptions as $description) $description->delete();

        //Suppression du gapGrade
        $gap = GapGrade::where([['spreadable_id', $sector->id], ['spreadable_type', 'App\Sector']])->first();
        if (isset($gap)) $gap->delete();

        //Suppression des photos
        $photos = Photo::where([['illustrable_id', $sector->id], ['illustrable_type', 'App\Sector']])->get();
        foreach ($photos as $photo) $photo->delete();

        //Suppression des photos
        $routes = Route::where('sector_id', $sector->id)->get();
        foreach ($routes as $route) $route->delete();

        try {
            Version::where([
                ['versionnable_id', '=', $sector->id],
                ['versionnable_type', '=', 'App\Sector']
            ])->delete();
        } catch (\Exception $e) {}
    }
}