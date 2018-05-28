<?php

namespace App\Observers;

use App\Massive;
use App\Version;

class MassiveObserver
{

    /**
     * Listen to the Massive updating event.
     *
     * @param Massive $massive
     * @return void
     */
    public function updating(Massive $massive)
    {
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