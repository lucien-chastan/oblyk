<?php

namespace App\Observers;


use App\PostPhoto;

class PostPhotoObserver
{

    /**
     * @param PostPhoto $photo
     */
    public function creating(PostPhoto $photo) {
        $photo->description = strip_tags($photo->description);
    }

    /**
     * @param PostPhoto $photo
     */
    public function updating(PostPhoto $photo) {
        $photo->description = strip_tags($photo->description);
    }

}