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

        if ($this->illustrable_type == 'App\Crag') {
            $name = Crag::find($this->illustrable_id)->label;
            $link = Crag::webUrl($this->illustrable_id, $name);
        }

        if($this->illustrable_type == 'App\Sector') {
            $sector = Sector::find($this->illustrable_id);
            $name = $sector->label;
            $link = Crag::webUrl($sector->crag_id, $name);
        }

        if ($this->illustrable_type == 'App\Route') {
            $name = Route::find($this->illustrable_id)->label;
            $link = route('routePage', ['route_id' => $this->illustrable_id, 'route_label' => str_slug($name)]);
        }

        return [
            'name' => $name,
            'link' => $link,
        ];
    }
}