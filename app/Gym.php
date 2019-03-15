<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    public $option_label = ['Standard', 'Premium', 'Pro'];
    public $fillable = ['label', 'address', 'postal_code', 'country', 'city', 'big_city', 'region', 'lat', 'lng'];

    protected $dates = [
        'option_start_date',
        'option_end_date'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function rooms()
    {
        return $this->hasMany('App\GymRoom', 'gym_id', 'id');
    }

    public function descriptions()
    {
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function posts()
    {
        return $this->morphMany('App\Post', 'postable');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'illustrable');
    }

    public function videos()
    {
        return $this->morphMany('App\Video', 'viewable');
    }

    public function links()
    {
        return $this->morphMany('App\Link', 'linkable');
    }

    public function follows()
    {
        return $this->morphMany('App\Follow', 'followed');
    }

    public function versions()
    {
        return $this->morphMany('App\Version', 'versionnable');
    }

    public function administrators()
    {
        return $this->hasMany('App\GymAdministrator', 'gym_id', 'id');
    }

    public function crosses()
    {
        return $this->hasMany('App\IndoorCross', 'gym_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany('App\GymGrade', 'gym_id', 'id');
    }

    public function level()
    {
        if ($this->option_start_date <= Carbon::now() && (Carbon::now() < $this->option_end_date || $this->option_end_date == null)) {
            return $this->option_level;
        } else {
            return 0;
        }
    }

    public function level_label()
    {
        return $this->option_label[$this->level()];
    }

    /**
     * @param int $size [50, 100]
     * @return string
     */
    public function logo($size = 100)
    {
        return file_exists(storage_path('app/public/gyms/' . $size . '/logo-' . $this->id . '.png')) ? '/storage/gyms/' . $size . '/logo-' . $this->id . '.png' : '/img/icon-search-gym.svg';
    }

    /**
     * @param int $size [200, 1300]
     * @return string
     */
    public function bandeau($size = 1300)
    {
        return file_exists(storage_path('app/public/gyms/' . $size . '/bandeau-' . $this->id . '.jpg')) ? '/storage/gyms/' . $size . '/bandeau-' . $this->id . '.jpg' : '/img/default-gym-bandeau.jpg';
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true)
    {
        return $this->webUrl($this->id, $this->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $label, $absolute = true)
    {
        return route(
            'gymPage',
            [
                'gym_id' => $id,
                'gym_label' => (str_slug($label) != '') ? str_slug($label) : 'salle'
            ],
            $absolute
        );
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function adminUrl($absolute = true)
    {
        return $this->adminWebUrl($this->id, $this->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function adminWebUrl($id, $label, $absolute = true)
    {
        return route(
            'gym_admin_home',
            [
                'gym_id' => $id,
                'gym_label' => (str_slug($label) != '') ? str_slug($label) : 'salle'
            ],
            $absolute
        );
    }

    public function userIsAdministrator($userId)
    {
        $GymAdministrator = GymAdministrator::class;
        return $GymAdministrator::where([['user_id', $userId], ['gym_id', $this->id]])->exists();
    }

    public function countAdministrator()
    {
        $GymAdministrator = GymAdministrator::class;
        return $GymAdministrator::where('gym_id', $this->id)->count();
    }

    public function type($format = 'html', $class = '')
    {
        $type = [];

        if ($format == 'html') {
            if ($this->type_route == 1) {
                $type[] = '<span class="type-gym-route ' . $class . '">' . trans('elements/climbs.climb_3') . '</span>';
            }
            if ($this->type_pan == 1) {
                $type[] = '<span class="type-gym-pan ' . $class . '">' . trans('elements/climbs.climb_pan') . '</span>';
            }
            if ($this->type_boulder == 1) {
                $type[] = '<span class="type-gym-boulder ' . $class . '">' . trans('elements/climbs.climb_2') . '</span>';
            }
        } else {
            if ($this->type_route == 1) {
                $type[] = trans('elements/climbs.climb_3');
            }
            if ($this->type_pan == 1) {
                $type[] = trans('elements/climbs.climb_pan');
            }
            if ($this->type_boulder == 1) {
                $type[] = trans('elements/climbs.climb_2');
            }
        }
        return implode(', ', $type);
    }
}
