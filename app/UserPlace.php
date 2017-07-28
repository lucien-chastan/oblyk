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

    public static function getPartnersAroundCenter ($lat, $lng){

        $user_id = [];
        $ids = DB::select('
                SELECT DISTINCT user_places.user_id AS  user_id
                FROM user_places
                INNER JOIN user_partner_settings
                ON user_places.user_id = user_partner_settings.user_id
                WHERE 
                    user_partner_settings.partner = 1 AND
                    user_places.active = 1 AND
                    user_places.rayon > getRange(:lat, :lng, user_places.lat, user_places.lng) / 1000
            ', [
            'lat' => $lat,
            'lng' => $lng
        ]);

        foreach ($ids as $id) $user_id[] = $id->user_id;

        return $user_id;
    }

}