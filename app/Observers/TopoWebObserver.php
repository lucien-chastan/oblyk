<?php

namespace App\Observers;


use App\TopoWeb;

class TopoWebObserver
{

    /**
     * @param TopoWeb $topoWeb
     */
    public function creating(TopoWeb $topoWeb) {
        $topoWeb->label = strip_tags($topoWeb->label);
        $topoWeb->url = strip_tags($topoWeb->url);
    }

    /**
     * @param TopoWeb $topoWeb
     */
    public function updating(TopoWeb $topoWeb) {
        $topoWeb->label = strip_tags($topoWeb->label);
        $topoWeb->url = strip_tags($topoWeb->url);
    }

}