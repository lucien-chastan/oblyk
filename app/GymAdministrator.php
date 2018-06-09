<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymAdministrator extends Model
{
    public $fillable = ['label'];

    public function gym() {
        return $this->hasOne('App\Gym','id', 'gym_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}