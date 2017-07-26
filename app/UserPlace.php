<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPlace extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public static function matchPlaces(){

        $userPlaces = UserPlace::where('user_id',Auth::id())->get();

        foreach ($userPlaces as $place){

        }
        $idPlaces = DB::select('
            SELECT myPlaces.id AS id
            FROM 
              user_places AS myPlaces,
              user_places AS otherPlaces
            WHERE 
              myPlaces.user_id = 1 AND 
              (myPlaces.rayon + otherPlaces.rayon) < getRange(myPlaces.lat, myPlaces.lng, otherPlaces.lat, otherPlaces.lng)
        ');

    }

}