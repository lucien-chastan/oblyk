<?php

namespace App\Observers;

use App\Link;

class LinkObserver
{

    /**
     * @param Link $link
     */
    public function creating(Link $link) {
        $link->label = strip_tags($link->label);
        $link->link = strip_tags($link->link);
        $link->description = strip_tags($link->description);
    }

    /**
     * @param Link $link
     */
    public function updating(Link $link) {
        $link->label = strip_tags($link->label);
        $link->link = strip_tags($link->link);
        $link->description = strip_tags($link->description);
    }
}