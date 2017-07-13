<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    public function userSocialNetworks(){
        return $this->hasMany('App\UserSocialNetwork','social_network_id', 'id');
    }
}