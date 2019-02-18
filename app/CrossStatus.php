<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossStatus extends Model
{
    public function crosses()
    {
        return $this->hasMany('App\Cross', 'status_id', 'id');
    }

    static function icon($status)
    {
        $icon = 'radio_button_unchecked';
        switch ($status) {
            case 1:
                $icon = 'crop_free';
                break;
            case 2:
                $icon = 'done';
                break;
            case 3:
                $icon = "check_box";
                break;
            case 4:
                $icon = "flash_on";
                break;
            case 5:
                $icon = "visibility";
                break;
            case 6:
                $icon = "loop";
                break;
        }
        return $icon;
    }
}