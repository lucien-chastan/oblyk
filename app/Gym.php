<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gym extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function posts(){
        return $this->morphMany('App\Post', 'postable');
    }

    public function search(){
        return $this->morphOne('App\Search', 'searchable');
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

}