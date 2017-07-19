<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class ViewCounter extends Model
{

    /**
     * Incrément de 1 le champs "views" du model passé en paramètre
     *
     * @param $model - model à incrémenter, doit contenir les champs "views" et "id"
     * @param $name - clé du model
     * @param int $minute - temps avant éxpiration, par défaut, une heur
     * @return mixed - retourne le model passé en paramètre
     */
    public static function IncrementViews($model, $name, $minute = 60){
        $session_id = Session::getId();
        if(!isset($_COOKIE[$name . $model->id . $session_id])){
            setcookie($name . $model->id . $session_id, true, ( time() + $minute * 60 ) );
            $model->views += 1;
            $model->save();
        }

        return $model;
    }
}