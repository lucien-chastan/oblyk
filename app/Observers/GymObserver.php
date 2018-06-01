<?php

namespace App\Observers;

use App\Gym;
use App\Version;

class GymObserver
{

    /**
     * Listen to the Gym updating event.
     *
     * @param Gym $gym
     * @return void
     */
    public function updating(Gym $gym)
    {
        $version = new Version();
        $version->saveVersion(Gym::find($gym->id), $gym, 'App\Gym');
    }

    /**
     * Listen to the Gym deleting event.
     *
     * @param Gym $gym
     * @return void
     */
    public function deleting(Gym $gym) {
        try {
            Version::where([
                ['versionnable_id', '=', $gym->id],
                ['versionnable_type', '=', 'App\Gym']
            ])->delete();
        } catch (\Exception $e) {}
    }
}