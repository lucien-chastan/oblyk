<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Massive extends Model
{

    public $fillable = ['label'];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function links(){
        return $this->morphMany('App\Link', 'linkable');
    }

    public function posts(){
        return $this->morphMany('App\Post', 'postable');
    }

    public function follows(){
        return $this->morphMany('App\Follow', 'followed');
    }

    public function crags(){
        return $this->hasMany('App\MassiveCrag','massive_id', 'id');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
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
            'massivePage',
            [
                'massive_id' => $id,
                'massive_label' => (str_slug($label) != '') ? str_slug($label) : 'regroupement'
            ],
            $absolute
        );
    }
}