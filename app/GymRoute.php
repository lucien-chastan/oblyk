<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymRoute extends Model
{
    public $colors = [];

    public $fillable = ['label'];

    protected $dates = ['opener_date', 'dismounted_at'];

    public function sector()
    {
        return $this->hasOne('App\GymSector', 'id', 'sector_id');
    }

    /**
     * @return array
     */
    public function holdColors()
    {
        $this->hold_colors = explode(';', $this->hold_color);
        return $this->hold_colors;
    }

    /**
     * @return array
     */
    public function tagColors()
    {
        $this->tag_colors = explode(';', $this->tag_color);
        return $this->tag_colors;
    }

    public function hasPicture()
    {
        return file_exists(storage_path('app/public/gyms/routes/1300/route-' . $this->id . '.jpg'));
    }

    public function picture($size = 200)
    {
        return $this->hasPicture() ? '/storage/gyms/routes/' . $size . '/route-' . $this->id . '.jpg' : '';
    }

    public function isFavorite()
    {
        return $this->favorite;
    }

    public function isDismounted()
    {
        return ($this->dismounted_at != null);
    }

    public function hasVideos()
    {
        $Video = Video::class;
        return ($Video::where([['viewable_id', $this->id], ['viewable_type', 'App\\GymRoute']])->count() > 0);
    }
}
