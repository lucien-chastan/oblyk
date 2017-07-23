<?php

namespace App;

use DebugBar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Follow extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function followed(){
        return $this->morphTo();
    }


    //ÉTABLIE LA RELATION QU'ON DEUX UTILISATEUR (L'AUTH ET UN USER CIBLE)
    public static function statusRelation($user_auth, $user_target){

        //si Auth suit User
        $followAuth = Follow::where([['user_id', $user_auth],['followed_id',$user_target],['followed_type','App\User']])->first();

        //si le User suit l'Auth
        $followUser = Follow::where([['user_id', $user_target],['followed_id', $user_auth],['followed_type','App\User']])->first();

        $relationStatus = 0;
        if(!isset($followAuth) && !isset($followUser)) $relationStatus = 0; //pas amis du tout
        if(isset($followAuth) && !isset($followUser)) $relationStatus = 1; //l'Auth suit => bt Annuler demande
        if(!isset($followAuth) && isset($followUser)) $relationStatus = 2; //l'user suit => bt Accepter demande
        if(isset($followAuth) && isset($followUser)) $relationStatus = 3; //Les deux suivent => bt caser relation

        return $relationStatus;
    }

}