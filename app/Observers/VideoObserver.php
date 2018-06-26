<?php

namespace App\Observers;


use App\Video;

class VideoObserver
{

    /**
     * @param Video $video
     */
    public function creating(Video $video) {
        $video->iframe = strip_tags($video->iframe);
        $video->description = strip_tags($video->description);
    }

    /**
     * @param Video $video
     */
    public function updating(Video $video) {
        $video->iframe = strip_tags($video->iframe);
        $video->description = strip_tags($video->description);
    }

}