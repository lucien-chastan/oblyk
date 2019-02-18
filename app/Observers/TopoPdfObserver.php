<?php

namespace App\Observers;


use App\TopoPdf;

class TopoPdfObserver
{

    /**
     * @param TopoPdf $topoPdf
     */
    public function creating(TopoPdf $topoPdf) {
        $topoPdf->label = strip_tags($topoPdf->label);
        $topoPdf->description = strip_tags($topoPdf->description);
        $topoPdf->author = strip_tags($topoPdf->author);
    }

    /**
     * @param TopoPdf $topoPdf
     */
    public function updating(TopoPdf $topoPdf) {
        $topoPdf->label = strip_tags($topoPdf->label);
        $topoPdf->description = strip_tags($topoPdf->description);
        $topoPdf->author = strip_tags($topoPdf->author);
    }

}