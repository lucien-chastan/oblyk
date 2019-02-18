<?php

namespace App\Observers;

use App\Gym;
use App\Version;

class GymObserver
{

    /**
     * @param Gym $gym
     */
    public function creating(Gym $gym) {
        $gym->label = strip_tags($gym->label);
        $gym->description = clean($gym->description);
        $gym->address = strip_tags($gym->address);
        $gym->postal_code = strip_tags($gym->postal_code);
        $gym->country = strip_tags($gym->country);
        $gym->city = strip_tags($gym->city);
        $gym->big_city = strip_tags($gym->big_city);
        $gym->region = strip_tags($gym->region);
        $gym->email = strip_tags($gym->email);
        $gym->phone_number = strip_tags($gym->phone_number);
        $gym->web_site = strip_tags($gym->web_site);
    }

    /**
     * Listen to the Gym updating event.
     *
     * @param Gym $gym
     * @return void
     */
    public function updating(Gym $gym)
    {
        $gym->label = strip_tags($gym->label);
        $gym->description = clean($gym->description);
        $gym->address = strip_tags($gym->address);
        $gym->postal_code = strip_tags($gym->postal_code);
        $gym->country = strip_tags($gym->country);
        $gym->city = strip_tags($gym->city);
        $gym->big_city = strip_tags($gym->big_city);
        $gym->region = strip_tags($gym->region);
        $gym->email = strip_tags($gym->email);
        $gym->phone_number = strip_tags($gym->phone_number);
        $gym->web_site = strip_tags($gym->web_site);

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