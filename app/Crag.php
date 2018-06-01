<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Log;

class Crag extends Model
{

    public $fillable = ['label', 'city', 'country', 'region', 'lat', 'lng'];

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

    public function gapGrade(){
        return $this->morphOne('App\GapGrade', 'spreadable');
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

    public function parkings(){
        return $this->hasMany('App\Parking','crag_id', 'id');
    }

    public function sectors(){
        return $this->hasMany('App\Sector','crag_id', 'id');
    }

    public function approaches(){
        return $this->hasMany('App\Approach','crag_id', 'id');
    }

    public function exceptions(){
        return $this->hasMany('App\Exception','crag_id', 'id');
    }

    public function topos(){
        return $this->hasMany('App\TopoCrag','crag_id', 'id');
    }

    public function massives(){
        return $this->hasMany('App\MassiveCrag','crag_id', 'id');
    }

    public function topoWebs(){
        return $this->hasMany('App\TopoWeb','crag_id', 'id');
    }

    public function topoPdfs(){
        return $this->hasMany('App\TopoPdf','crag_id', 'id');
    }

    public function routes(){
        return $this->hasMany('App\Route','crag_id', 'id');
    }
    public function routeSections(){
        return $this->hasManyThrough('App\RouteSection', 'App\Route');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
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


    //met à jour les informations stocké de la falaise en question
    public static function majInformation($crag_id){

        $routes = Route::where('crag_id',$crag_id)->with('routeSections')->get();
        $crag = Crag::where('id', $crag_id)->with('gapGrade')->first();

        $type_bloc = 0;
        $type_voie = 0;
        $type_grande_voie = 0;
        $type_deep_water = 0;
        $via_ferrata = 0;

        //min et max
        $min_grade_val = 100;
        $min_grade_text = '?';
        $max_grade_val = 0;
        $max_grade_text = '?';

        foreach ($routes as $route){

            //type de ligne
            if($route->climb_id == 2) $type_bloc = 1;
            if($route->climb_id == 3) $type_voie = 1;
            if($route->climb_id == 4 || $route->climb_id == 5 || $route->climb_id == 6) $type_grande_voie = 1;
            if($route->climb_id == 7) $type_deep_water = 1;
            if($route->climb_id == 8) $via_ferrata = 1;

            foreach ($route->routeSections as $section){
                if($section->grade_val < $min_grade_val && $section->grade_val > 0){
                    $min_grade_val = $section->grade_val;
                    $min_grade_text = $section->grade . $section->sub_grade;
                }
                if($section->grade_val > $max_grade_val){
                    $max_grade_val = $section->grade_val;
                    $max_grade_text = $section->grade . $section->sub_grade;
                }
            }
            $min_grade_val = ($min_grade_val == 100) ? 0 : $min_grade_val; // if no min value - set it as 0/? since there is no other grades
        }

        //MISE À JOUR DU TYPE DE VOIE
        $crag->type_voie = $type_voie;
        $crag->type_bloc = $type_bloc;
        $crag->type_grande_voie = $type_grande_voie;
        $crag->type_deep_water = $type_deep_water;
        $crag->type_via_ferrata = $via_ferrata;
        $crag->save();


        //MISE À JOUR DE L'ÉCART DE COTATION
        if(isset($crag->gapGrade)){
            $crag->gapGrade->min_grade_val = $min_grade_val;
            $crag->gapGrade->min_grade_text = $min_grade_text;
            $crag->gapGrade->max_grade_val = $max_grade_val;
            $crag->gapGrade->max_grade_text = $max_grade_text;
            $crag->gapGrade->save();
        }else{
            $gapGrade = new GapGrade();
            $gapGrade->spreadable_id = $crag->id;
            $gapGrade->spreadable_type = 'App\Crag';
            $gapGrade->min_grade_val = $min_grade_val;
            $gapGrade->min_grade_text = $min_grade_text;
            $gapGrade->max_grade_val = $max_grade_val;
            $gapGrade->max_grade_text = $max_grade_text;
            $gapGrade->save();
        }
    }
}
