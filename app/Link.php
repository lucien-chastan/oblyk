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
            $link = route('cragPage', ['crag_id' => $this->linkable_id, 'crag_label' => str_slug($name)]);
        }

        if ($this->linkable_type == 'App\Topo') {
            $name = Topo::find($this->linkable_id)->label;
            $link = route('topoPage', ['topo_id' => $this->linkable_id, 'topo_label' => str_slug($name)]);
        }

        if ($this->linkable_type == 'App\Massive') {
            $name = Massive::find($this->linkable_id)->label;
            $link = route('massivePage', ['massive_id' => $this->linkable_id, 'massive_label' => str_slug($name)]);
        }

        return [
            'name' => $name,
            'link' => $link,
        ];
    }
}