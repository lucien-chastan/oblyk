<?php

namespace App\Observers;

use App\Approach;

class ApproachObserver
{

    /**
     * @param Approach $approach
     */
    public function creating(Approach $approach) {
        $approach->description = strip_tags($approach->description);
    }

    /**
     * @param Approach $approach
     */
    public function updating(Approach $approach) {
        $approach->description = strip_tags($approach->description);
    }

}