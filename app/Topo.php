<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Topo extends Model
{
    public $fillable = ['label', 'author', 'editor'];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function links(){
        return $this->morphMany('App\Link', 'linkable');
    }

    public function follows(){
        return $this->morphMany('App\Follow', 'followed');
    }

    public function posts(){
        return $this->morphMany('App\Post', 'postable');
    }

    public function crags(){
        return $this->hasMany('App\TopoCrag','topo_id', 'id');
    }

    public function sales(){
        return $this->hasMany('App\TopoSale','topo_id', 'id');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }
}