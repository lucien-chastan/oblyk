<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gym extends Model
{

    public $fillable = ['label', 'address', 'postal_code', 'country', 'city', 'big_city', 'region', 'lat', 'lng'];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function posts(){
        return $this->morphMany('App\Post', 'postable');
    }

    public function photos(){
        return $this->morphMany('App\Photo', 'illustrable');
    }

    public function videos(){
        return $this->morphMany('App\Video', 'viewable');
    }

    public function links(){
        return $this->morphMany('App\Link', 'linkable');
    }

    public function follows(){
        return $this->morphMany('App\Follow', 'followed');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }

}