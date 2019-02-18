<?php

namespace App\Observers;

use App\Topo;
use App\Version;

class TopoObserver
{

    /**
     * @param Topo $topo
     */
    public function creating(Topo $topo) {
        $topo->label = strip_tags($topo->label);
        $topo->author = strip_tags($topo->author);
        $topo->editor = strip_tags($topo->editor);
    }

    /**
     * Listen to the Topo updating event.
     *
     * @param Topo $topo
     * @return void
     */
    public function updating(Topo $topo)
    {
        $topo->label = strip_tags($topo->label);
        $topo->author = strip_tags($topo->author);
        $topo->editor = strip_tags($topo->editor);

        $version = new Version();
        $version->saveVersion(Topo::find($topo->id), $topo, 'App\Topo');
    }

    /**
     * Listen to the Topo deleting event.
     *
     * @param Topo $topo
     * @return void
     */
    public function deleting(Topo $topo) {
        try {
            Version::where([
                ['versionnable_id', '=', $topo->id],
                ['versionnable_type', '=', 'App\Topo']
            ])->delete();
        } catch (\Exception $e) {}
    }
}