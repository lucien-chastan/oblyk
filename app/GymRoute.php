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
    public function colors()
    {
        $this->colors = explode(';', $this->color);
        return $this->colors;
    }

    public function hasPicture()
    {
        return file_exists(storage_path('app/public/gyms/routes/1300/route-' . $this->id . '.jpg'));
    }

    public function picture($size = 200)
    {
        return $this->hasPicture() ? '/storage/gyms/routes/' . $size . '/route-' . $this->id . '.jpg' : '';
    }

    public function hasThumbnail()
    {
        return file_exists(storage_path('app/public/gyms/routes/100/thumbnail-' . $this->id . '.jpg'));
    }

    public function thumbnail()
    {
        return $this->hasThumbnail() ? '/storage/gyms/routes/100/thumbnail-' . $this->id . '.jpg' : '';
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

    public function estimateGradeLevel($gymGradeId) {
        $GymGradeLine = GymGradeLine::class;
        $gymGradeLines = $GymGradeLine::where('gym_grade_id', $gymGradeId)->orderBy('order')->get();
        $minScore = 100;
        $gradeLineId = 0;

        foreach ($gymGradeLines as $gymGradeLine) {
            $valGradDiff = abs($gymGradeLine->grade_val - $this->val_grade);
            if ($valGradDiff < $minScore) {
                $minScore = $valGradDiff;
                $gradeLineId = $gymGradeLine->id;
            }
        }

        return $gradeLineId;
    }
}
