<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crag extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function rock(){
        return $this->hasOne('App\Rock','id', 'rock_id');
    }

    public function orientation(){
        return $this->morphOne('App\Orientation', 'orientable');
    }

    public function season(){
        return $this->morphOne('App\Season', 'seasontable');
    }

    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

}