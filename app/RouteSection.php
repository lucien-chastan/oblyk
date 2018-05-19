<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteSection extends Model
{
    public function route(){
        return $this->hasOne('App\Route','id', 'route_id');
    }

    public function anchor(){
        return $this->hasOne('App\Anchor','id', 'anchor_id');
    }

    public function point(){
        return $this->hasOne('App\Point','id', 'point_id');
    }

    public function incline(){
        return $this->hasOne('App\Incline','id', 'incline_id');
    }

    public function reception(){
        return $this->hasOne('App\Reception','id', 'reception_id');
    }

    public function start(){
        return $this->hasOne('App\Start','id', 'start_id');
    }

    public function CrossSections(){
        return $this->hasMany('App\CrossSection','route_section_id', 'id');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }
}