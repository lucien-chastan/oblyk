<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function viewable(){
        return $this->morphTo();
    }

    public static function convertUrl($url){

        $good_url = $url;

        //EPIC TV : Si nous somme sur une vidéo du type Épic TV
        if(preg_match('/epictv.com/', $url) == 1){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://www.epictv.com/player/embed-player/' . end($splitUrl);
        }

        //YOUTUBE : Si nous somme sur une vidéo de youtube de type lien court
        if(preg_match('/youtu.be/', $url) == 1){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://www.youtube.com/embed/' . end($splitUrl);
        }

        //YOUTUBE : Si nous somme sur une vidéo de youtube de type lien long
        if(preg_match('/youtube.com/', $url) == 1){
            if(preg_match('/embed/', $url) != 1){
                $arrayUrl = parse_url($url, PHP_URL_QUERY);
                $splitUrl = explode('=',$arrayUrl);
                $good_url = 'https://www.youtube.com/embed/' . $splitUrl[1];
            }
        }

        // VIEMO : Si nous somme sur une vidéo de viméo
        if(preg_match('/vimeo.com/', $url) == 1){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://player.vimeo.com/video/' . end($splitUrl);
        }

        //DAILYMOTION : Si nous somme sur une vidéo dailymotion court
        if(preg_match('/dai.ly/', $url) == 1){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = '//www.dailymotion.com/embed/video/' . end($splitUrl);
        }

        // DAILYMOTION : Si nous somme sur une vidéo dailymotion long
        if(preg_match('/dailymotion.com/', $url) == 1){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $splitUrl = explode('_', end($splitUrl));
            $good_url = '//www.dailymotion.com/embed/video/' . $splitUrl[0];
        }

        return $good_url;
    }

    public function getTargetLink (){
        $link = '';
        $name = '';

        if ($this->viewable_type == 'App\Crag') {
            $name = Crag::find($this->viewable_id)->label;
            $link = route('cragPage', ['crag_id' => $this->viewable_id, 'crag_label' => str_slug($name)]);
        }

        if ($this->viewable_type == 'App\Route') {
            $name = Route::find($this->viewable_id)->label;
            $link = route('routePage', ['route_id' => $this->viewable_id, 'route_label' => str_slug($name)]);
        }

        if ($this->viewable_type == 'App\Gym') {
            $name = Gym::find($this->viewable_id)->label;
            $link = route('gymPage', ['gym_id' => $this->viewable_id, 'gym_label' => str_slug($name)]);
        }

        return [
            'name' => $name,
            'link' => $link,
        ];
    }

}