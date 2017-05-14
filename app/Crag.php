<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function links(){
        return $this->morphMany('App\Link', 'linkable');
    }

    public function parkings(){
        return $this->hasMany('App\Parking','crag_id', 'id');
    }

    public static function getCragsAroundPoint($lat, $lng, $rayon){
        //retourne les falaises dans un certain rayon
        $cragsInRayon = DB::select(
            'SELECT id FROM crags WHERE getRange(lat, lng, :lat, :lng) <= :rayon',
            [
                'lat' => $lat,
                'lng' => $lng,
                'rayon' => $rayon * 1000
            ]
        );

        return $cragsInRayon;
    }

}