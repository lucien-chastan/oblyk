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

    public function administrators (){
        return $this->hasMany('App\GymAdministrator', 'gym_id','id');
    }

    /**
     * @param int $size [50, 100]
     * @return string
     */
    public function logo ($size = 100) {
        return file_exists(storage_path('app/public/gyms/' . $size . '/logo-' . $this->id . '.png')) ? '/storage/gyms/' . $size . '/logo-' . $this->id . '.png' : '/img/icon-search-gym.svg';
    }

    /**
     * @param int $size [200, 1300]
     * @return string
     */
    public function bandeau ($size = 1300) {
        return file_exists(storage_path('app/public/gyms/' . $size . '/bandeau-' . $this->id . '.jpg')) ? '/storage/gyms/' . $size . '/bandeau-' . $this->id . '.jpg' : '/img/default-gym-bandeau.jpg';
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
}
