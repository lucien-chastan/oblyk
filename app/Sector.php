<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sector extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
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

    public function rain(){
        return $this->hasOne('App\Rain','id', 'rain_id');
    }

    public function sun(){
        return $this->hasOne('App\Sun','id', 'sun_id');
    }
}