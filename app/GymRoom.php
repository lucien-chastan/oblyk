<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymRoom extends Model
{
    public function gym() {
        return $this->hasOne('App\Gym','id', 'gym_id');
    }

    public function sectors() {
        return $this->hasMany('App\GymSector','room_id', 'id');
    }
}