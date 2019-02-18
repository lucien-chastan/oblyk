<?php

namespace App\Observers;


use App\Album;

class AlbumObserver
{

    /**
     * @param Album $album
     */
    public function creating(Album $album) {
        $album->description = strip_tags($album->description);
        $album->label = strip_tags($album->label);
    }

    /**
     * @param Album $album
     */
    public function updating(Album $album) {
        $album->description = strip_tags($album->description);
        $album->label = strip_tags($album->label);
    }

}