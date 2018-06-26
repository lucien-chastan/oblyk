<?php

namespace App\Observers;

use App\Crag;
use App\Version;

class CragObserver
{

    /**
     * @param Crag $crag
     */
    public function creating(Crag $crag) {
        $crag->label = strip_tags($crag->label);
        $crag->country = strip_tags($crag->country);
        $crag->city = strip_tags($crag->city);
        $crag->region = strip_tags($crag->region);
    }

    /**
     * Listen to the Crag updating event.
     *
     * @param Crag $crag
     * @return void
     */
    public function updating(Crag $crag)
    {
        $crag->label = strip_tags($crag->label);
        $crag->country = strip_tags($crag->country);
        $crag->city = strip_tags($crag->city);
        $crag->region = strip_tags($crag->region);

        $version = new Version();
        $version->saveVersion(
            Crag::where('id',$crag->id)
                ->with('orientation')
                ->with('season')
                ->first(),
            $crag,
            'App\Crag'
        );
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