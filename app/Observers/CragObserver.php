<?php

namespace App\Observers;

use App\Crag;
use App\Version;

class CragObserver
{

    /**
     * Listen to the Crag updating event.
     *
     * @param Crag $crag
     * @return void
     */
    public function updating(Crag $crag)
    {
        $version = new Version();
        $version->saveVersion(Crag::find($crag->id), $crag, 'App\Crag');
    }

    /**
     * Listen to the Crag deleting event.
     *
     * @param Crag $crag
     * @return void
     */
    public function deleting(Crag $crag) {
        try {
            Version::where([
                ['versionnable_id', '=', $crag->id],
                ['versionnable_type', '=', 'App\Crag']
            ])->delete();
        } catch (\Exception $e) {}
    }
}