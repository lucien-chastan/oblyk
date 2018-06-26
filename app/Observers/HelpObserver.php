<?php

namespace App\Observers;


use App\Help;

class HelpObserver
{

    /**
     * @param Help $help
     */
    public function creating(Help $help) {
        $help->category = strip_tags($help->category);
        $help->label = strip_tags($help->label);
        $help->contents = clean($help->contents);
    }

    /**
     * @param Help $help
     */
    public function updating(Help $help) {
        $help->category = strip_tags($help->category);
        $help->label = strip_tags($help->label);
        $help->contents = clean($help->contents);
    }

}