<?php

namespace App\Observers;


use App\UserPlace;

class UserPlaceObserver
{

    /**
     * @param UserPlace $userPlace
     */
    public function creating(UserPlace $userPlace) {
        $userPlace->label = strip_tags($userPlace->label);
        $userPlace->description = strip_tags($userPlace->description);
    }

    /**
     * @param UserPlace $userPlace
     */
    public function updating(UserPlace $userPlace) {
        $userPlace->label = strip_tags($userPlace->label);
        $userPlace->description = strip_tags($userPlace->description);
    }

}