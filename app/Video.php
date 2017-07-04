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

        //Si nous somme sur une vidéo du type Épic TV
        $EpicReg = preg_split("/epictv.com/", $url);
        if(count($EpicReg) > 0){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://www.epictv.com/player/embed-player/' . end($splitUrl);
        }

        //Si nous somme sur une vidéo de youtube de type lien court
        $ShortYoutubeReg = preg_split("/youtu.be/", $url);
        if(count($ShortYoutubeReg) > 0){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://www.youtube.com/embed/' . end($splitUrl);
        }

        //Si nous somme sur une vidéo de youtube de type lien long
        $vimeoReg = preg_split("/vimeo.com/", $url);
        if(count($vimeoReg) > 0){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://player.vimeo.com/video/' . end($splitUrl);
        }

        //Si nous somme sur une vidéo de youtube de type lien long
        $vimeoReg = preg_split("/vimeo.com/", $url);
        if(count($vimeoReg) > 0){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = 'https://player.vimeo.com/video/' . end($splitUrl);
        }

        //Si nous somme sur une vidéo dailymotion court
        $dailyShortReg = preg_split("/dail.ly/", $url);
        if(count($dailyShortReg) > 0){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/',$arrayUrl);
            $good_url = '//www.dailymotion.com/embed/video/' . end($splitUrl);
        }

        //Si nous somme sur une vidéo dailymotion long
        $dailyReg = preg_split("/dailymotion.com/", $url);
        if(count($dailyReg) > 0){
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $splitUrl = explode('_', end($splitUrl));
            $good_url = '//www.dailymotion.com/embed/video/' . $splitUrl[0];
        }

        return $good_url;
    }

}