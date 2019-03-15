<?php

namespace App\Observers;


use App\Cross;
use App\CrossSection;
use App\CrossUser;
use App\Description;

class CrossObserver
{

    /**
     * Listen to the Cross deleting event.
     *
     * @param Cross $cross
     * @return void
     * @throws \Exception
     */
    public function deleting(Cross $cross)
    {
        CrossSection::where('cross_id',$cross->id)->delete();
        CrossUser::where('cross_id', $cross->id)->delete();
        Description::where(
            [
                ['descriptive_id', $cross->id],
                ['descriptive_type', 'App\Cross'],
                ['user_id', $cross->user_id],
            ]
        )->delete();
    }
}