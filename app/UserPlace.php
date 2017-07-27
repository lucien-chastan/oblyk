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

        $userPlaces = UserPlace::where([['user_id',Auth::id()],['active',1]])->get();
        $placeIds = [];

        foreach ($userPlaces as $place){
            $ids = DB::select('
                SELECT id
                FROM user_places
                WHERE
                  user_id != :user_id AND
                  (:rayon + rayon) > getRange(:lat, :lng, lat, lng) / 1000
            ', [
                'user_id'=>Auth::id(),
                'rayon' => $place->rayon,
                'lat' => $place->lat,
                'lng' => $place->lng
            ]);

            foreach ($ids as $id){
                if(!in_array($id->id, $placeIds)) $placeIds[] = $id->id;
            }
        }

        return $placeIds;
    }

}