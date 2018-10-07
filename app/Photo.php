<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function album(){
        return $this->hasOne('App\Album','id', 'album_id');
    }

    public function illustrable(){
        return $this->morphTo();
    }

    public function getTargetLink (){
        $link = '';
        $name = '';
        $element = '';

        if ($this->illustrable_type == 'App\Crag') {
            $crag = Crag::class;
            $element =  $crag::find($this->illustrable_id);
            $name = $element->label;
            $link = Crag::webUrl($this->illustrable_id, $name);
        }

        if($this->illustrable_type == 'App\Sector') {
            $sector = Sector::class;
            $element = $sector::find($this->illustrable_id);
            $name = $element->label;
            $link = Crag::webUrl($element->crag_id, $name);
        }

        if ($this->illustrable_type == 'App\Route') {
            $route = Route::class;
            $element = $route::find($this->illustrable_id);
            $name =$element->label;
            $link = Route::webUrl($this->illustrable_id, $name);
        }

        return [
            'name' => $name,
            'link' => $link,
            'element' => $element,
        ];
    }

    /**
     * @param array|object $photos
     * @return string
     */
    static function queryCollection ($photos) : string
    {
        $collections = [];
        foreach ($photos as $photo) {
            $collections[] = $photo->id;
        }
        sort($collections);
        return (count($collections) > 1) ? '?photos=' . join(',', $collections) : '';
    }

    /**
     * @return string
     */
    public function getCreative() :string
    {
        $creative = [];
        if($this->copyright_by === 1 || $this->copyright_by === null) {
            $creative[] = 'BY';
        }

        if($this->copyright_nc === 1 || $this->copyright_nc === null) {
            $creative[] = 'NC';
        }

        if($this->copyright_nd === 1 || $this->copyright_nd === null) {
            $creative[] = 'ND';
        }

        return join(' - ', $creative);
    }

    public function getLatLng()
    {
        if ($this->illustrable_type == 'App\Crag') {
            $crag_id =  $this->illustrable_id;
        }

        if($this->illustrable_type == 'App\Sector') {
            $sector = Sector::class;
            $element = $sector::find($this->illustrable_id);
            $crag_id = $element->crag_id;
        }

        if ($this->illustrable_type == 'App\Route') {
            $route = Route::class;
            $element = $route::find($this->illustrable_id);
            $crag_id = $element->crag_id;
        }

        $crag = Crag::class;
        $crag = $crag::find($crag_id);

        $this->lat = $crag->lat;
        $this->lng = $crag->lng;
    }

    function getAlt() {
        if ($this->illustrable_type == 'App\Crag') {
            $crag = Crag::class;
            $element = $crag::find($this->illustrable_id);
            return "Site d'escalade $element->label";
        }

        if ($this->illustrable_type == 'App\Sector') {
            $sector = Sector::class;
            $element = $sector::find($this->illustrable_id);
            return "Secteur d'escalade $element->label";
        }

        if ($this->illustrable_type == 'App\Route') {
            $route = Route::class;
            $element = $route::find($this->illustrable_id);
            return "Voie d'escalade $element->label";
        }

        return "Photo d'escalade";
    }
}