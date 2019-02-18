<?php

namespace App\Observers;


use App\UserSocialNetwork;

class UserSocialNetworkObserver
{

    /**
     * @param UserSocialNetwork $userSocialNetwork
     */
    public function creating(UserSocialNetwork $userSocialNetwork) {
        $userSocialNetwork->label = strip_tags($userSocialNetwork->label);
        $userSocialNetwork->url = strip_tags($userSocialNetwork->url);
    }

    /**
     * @param UserSocialNetwork $userSocialNetwork
     */
    public function updating(UserSocialNetwork $userSocialNetwork) {
        $userSocialNetwork->label = strip_tags($userSocialNetwork->label);
        $userSocialNetwork->url = strip_tags($userSocialNetwork->url);
    }

}