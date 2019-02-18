<?php

namespace App\Observers;


use App\SocialNetwork;

class SocialNetworkObserver
{

    /**
     * @param SocialNetwork $socialNetwork
     */
    public function creating(SocialNetwork $socialNetwork) {
        $socialNetwork->label = strip_tags($socialNetwork->label);
    }

    /**
     * @param SocialNetwork $socialNetwork
     */
    public function updating(SocialNetwork $socialNetwork) {
        $socialNetwork->label = strip_tags($socialNetwork->label);
    }

}