<?php

namespace App\Observers;


use App\TopoSale;

class TopoSaleObserver
{

    /**
     * @param TopoSale $topoSale
     */
    public function creating(TopoSale $topoSale) {
        $topoSale->label = strip_tags($topoSale->label);
        $topoSale->description = strip_tags($topoSale->description);
        $topoSale->url = strip_tags($topoSale->url);
    }

    /**
     * @param TopoSale $topoSale
     */
    public function updating(TopoSale $topoSale) {
        $topoSale->label = strip_tags($topoSale->label);
        $topoSale->description = strip_tags($topoSale->description);
        $topoSale->url = strip_tags($topoSale->url);
    }

}