<?php

namespace App\Observers;


use App\Description;

class DescriptionObserver
{

    /**
     * @param Description $description
     */
    public function creating(Description $description) {
        $description->description = clean($description->description);
    }

    /**
     * @param Description $description
     */
    public function updating(Description $description) {
        $description->description = clean($description->description);
    }

}