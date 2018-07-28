<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function linkable(){
        return $this->morphTo();
    }

    public function getTargetLink (){
        $link = '';
        $name = '';

        if ($this->linkable_type == 'App\Crag') {
            $name = Crag::find($this->linkable_id)->label;
            $link = Crag::webUrl($this->linkable_id,$name);
        }

        if ($this->linkable_type == 'App\Topo') {
            $name = Topo::find($this->linkable_id)->label;
            $link = Topo::webUrl($this->linkable_id, $name);
        }

        if ($this->linkable_type == 'App\Massive') {
            $name = Massive::find($this->linkable_id)->label;
            $link = Massive::webUrl($this->linkable_id, $name);
        }

        return [
            'name' => $name,
            'link' => $link,
        ];
    }
}