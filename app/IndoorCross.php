<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndoorCross extends Model
{

    protected $dates = [
        'release_at'
    ];

    public function gym(){
        return $this->hasOne('App\Gym','id', 'gym_id');
    }

    public function room(){
        return $this->hasOne('App\GymRoom','id', 'room_id');
    }

    public function sector(){
        return $this->hasOne('App\GymSector','id', 'sector_id');
    }

    public function route(){
        return $this->hasOne('App\GymRoute','id', 'route_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crossStatus(){
        return $this->hasOne('App\CrossStatus','id', 'status_id');
    }

    public function crossMode(){
        return $this->hasOne('App\CrossMode','id', 'mode_id');
    }

    public function hasRoom()
    {
        return ($this->room_id);
    }

    public function hasSector()
    {
        return ($this->sector_id);
    }

    public function hasRoute()
    {
        return ($this->route_id);
    }

}