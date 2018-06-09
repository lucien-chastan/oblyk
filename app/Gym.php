<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gym extends Model
{

    public $fillable = ['label', 'address', 'postal_code', 'country', 'city', 'big_city', 'region', 'lat', 'lng'];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function rooms(){
        return $this->hasMany('App\GymRoom','gym_id', 'id');
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

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }

     /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true) {
        return $this->webUrl($this->id, $this->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $label, $absolute = true) {
        return route(
            'gymPage',
            [
                'gym_id' => $id,
                'gym_label' => (str_slug($label) != '') ? str_slug($label) : 'salle'
            ],
            $absolute
        );
    }

    public function administrators (){
        return $this->hasMany('App\GymAdministrator', 'gym_id','id');
    }
}
