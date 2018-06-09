<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymSector extends Model
{

    public $fillable = ['label'];

    public function gym() {
        return $this->hasOne('App\Gym','id', 'gym_id');
    }

    public function routes() {
        return $this->hasMany('App\GymRoute', 'sector_id', 'id');
    }
}