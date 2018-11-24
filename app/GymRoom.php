<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymRoom extends Model
{
    public function gym()
    {
        return $this->hasOne('App\Gym', 'id', 'gym_id');
    }

    public function sectors()
    {
        return $this->hasMany('App\GymSector', 'room_id', 'id');
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true)
    {
        $Gym = Gym::class;
        $gym = $Gym::find($this->gym_id)->select('label')->first();
        return $this->webUrl($this->id, $this->gym_id, $gym->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $gym_id, $label, $absolute = true)
    {
        return route(
            'gymSchemePage',
            [
                'gym_id' => $gym_id,
                'room_id' => $id,
                'gym_label' => (str_slug($label) != '') ? str_slug($label) : 'salle'
            ],
            $absolute
        );
    }

    public function hasScheme()
    {
        return (file_exists(storage_path('app/public/gyms/schemes/scheme-' . $this->id . '.png')));
    }
}