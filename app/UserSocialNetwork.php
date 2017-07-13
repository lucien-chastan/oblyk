<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocialNetwork extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function socialNetwork(){
        return $this->hasOne('App\SocialNetwork','id', 'social_network_id');
    }
}