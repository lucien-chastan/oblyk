<?php

namespace App\Observers;

use App\Massive;
use App\Version;

class MassiveObserver
{

    /**
     * @param Massive $massive
     */
    public function creating(Massive $massive) {
        $massive->label = strip_tags($massive->label);
    }

    /**
     * Listen to the Massive updating event.
     *
     * @param Massive $massive
     * @return void
     */
    public function updating(Massive $massive)
    {
        $massive->label = strip_tags($massive->label);

        $version = new Version();
        $version->saveVersion(Massive::find($massive->id), $massive, 'App\Massive');
    }

    /**
     * Listen to the Massive deleting event.
     *
     * @param Massive $massive
     * @return void
     */
    public function deleting(Massive $massive) {
        try {
            Version::where([
                ['versionnable_id', '=', $massive->id],
                ['versionnable_type', '=', 'App\Massive']
            ])->delete();
        } catch (\Exception $e) {}
    }
}