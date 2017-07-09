<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Massive extends Model
{
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

    public function crags(){
        return $this->hasMany('App\MassiveCrag','massive_id', 'id');
    }

    public static function distincRegions($massive_id){
        $regions = DB::select('
            SELECT DISTINCT crags.region AS region FROM crags 
            INNER JOIN massive_crags
            ON crags.id = massive_crags.crag_id
            WHERE massive_crags.massive_id = :massive_id',
            [
                'massive_id' => $massive_id
            ]
        );

        return $regions;
    }
}