<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function viewable()
    {
        return $this->morphTo();
    }

    public static function convertUrl($url)
    {
        $good_url = $url;

        // Epic TV
        if (preg_match('/epictv.com/', $url) == 1) {
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $good_url = 'https://www.epictv.com/player/embed-player/' . end($splitUrl);
        }

        // Youtube : short url
        if (preg_match('/youtu.be/', $url) == 1) {
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $good_url = 'https://www.youtube.com/embed/' . end($splitUrl);
        }

        // Youtube : long url
        if (preg_match('/youtube.com/', $url) == 1) {
            if (preg_match('/embed/', $url) != 1) {
                $arrayUrl = parse_url($url, PHP_URL_QUERY);
                $splitUrl = explode('=', $arrayUrl);
                $good_url = 'https://www.youtube.com/embed/' . $splitUrl[1];
            }
        }

        // Viemo
        if (preg_match('/vimeo.com/', $url) == 1) {
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $good_url = 'https://player.vimeo.com/video/' . end($splitUrl);
        }

        // Dailymotion : short url
        if (preg_match('/dai.ly/', $url) == 1) {
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $good_url = '//www.dailymotion.com/embed/video/' . end($splitUrl);
        }

        // Dailymotion : long url
        if (preg_match('/dailymotion.com/', $url) == 1) {
            $arrayUrl = parse_url($url, PHP_URL_PATH);
            $splitUrl = explode('/', $arrayUrl);
            $splitUrl = explode('_', end($splitUrl));
            $good_url = '//www.dailymotion.com/embed/video/' . $splitUrl[0];
        }

        return $good_url;
    }

    public function getTargetLink()
    {
        $link = '';
        $name = '';

        if ($this->viewable_type == 'App\Crag') {
            $name = Crag::find($this->viewable_id)->label;
            $link = Crag::webUrl($this->viewable_id, $name);
        }

        if ($this->viewable_type == 'App\Route') {
            $name = Route::find($this->viewable_id)->label;
            $link = Route::webUrl($this->viewable_id, $name);
        }

        if ($this->viewable_type == 'App\Gym') {
            $name = Gym::find($this->viewable_id)->label;
            $link = Gym::webUrl($this->viewable_id, $name);
        }

        return [
            'name' => $name,
            'link' => $link,
        ];
    }

    public function htmlIframe($height = 480, $width = 853, $withContainer = true)
    {
        if ($withContainer) {
            return '<div class="video-container"><iframe width="'. $width . '" height="'. $height . '" src="' . $this->iframe . '" allowfullscreen frameborder="0"></iframe></div>';
        } else {
            return '<iframe width="'. $width . '" height="'. $height . '" src="' . $this->iframe . '" allowfullscreen frameborder="0"></iframe>';
        }
    }
}