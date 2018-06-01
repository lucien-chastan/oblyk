<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
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

    public function photos(){
        return $this->morphMany('App\Photo', 'illustrable');
    }

    public function rain(){
        return $this->hasOne('App\RainExposure','id', 'rain_id');
    }

    public function sun(){
        return $this->hasOne('App\Sun','id', 'sun_id');
    }

    public function routes(){
        return $this->hasMany('App\Route','sector_id','id');
    }
    public function routeSections(){
        return $this->hasManyThrough('App\RouteSection', 'App\Route');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }

    //MET À JOUR LES INFORMATIONS STOCKÉES DU SECTEUR (ÉCART DE COTATION)
    public static function majInformation($sector_id){
        $routes = Route::where('sector_id',$sector_id)->with('routeSections')->get();
        $sector = Sector::where('id', $sector_id)->with('gapGrade')->first();

        //min et max
        $min_grade_val = 100;
        $min_grade_text = '?';
        $max_grade_val = 0;
        $max_grade_text = '?';

        foreach ($routes as $route){
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
        }
        $min_grade_val = ($min_grade_val == 100) ? 0 : $min_grade_val; // if no min value - set it as 0/? since there is no other grades

        //MISE À JOUR DE L'ÉCART DE COTATION
        if(isset($sector->gapGrade)){
            $sector->gapGrade->min_grade_val = $min_grade_val;
            $sector->gapGrade->min_grade_text = $min_grade_text;
            $sector->gapGrade->max_grade_val = $max_grade_val;
            $sector->gapGrade->max_grade_text = $max_grade_text;
            $sector->gapGrade->save();
        }else{
            $gapGrade = new GapGrade();
            $gapGrade->spreadable_id = $sector->id;
            $gapGrade->spreadable_type = 'App\Sector';
            $gapGrade->min_grade_val = $min_grade_val;
            $gapGrade->min_grade_text = $min_grade_text;
            $gapGrade->max_grade_val = $max_grade_val;
            $gapGrade->max_grade_text = $max_grade_text;
            $gapGrade->save();
        }
    }
}
