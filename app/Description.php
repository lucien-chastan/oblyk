<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function descriptive()
    {
        return $this->morphTo();
    }
}
