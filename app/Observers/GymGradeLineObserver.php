<?php

namespace App\Observers;

use App\GymGradeLine;

class GymGradeLineObserver
{

    /**
     * @param GymGradeLine $gradeLine
     */
    public function creating(GymGradeLine $gradeLine) {
        $gradeLine->label = strip_tags($gradeLine->label);
    }

    /**
     * Listen to the GymGradeLine updating event.
     *
     * @param GymGradeLine $gradeLine
     * @return void
     */
    public function updating(GymGradeLine $gradeLine)
    {
        $gradeLine->label = strip_tags($gradeLine->label);
    }
}