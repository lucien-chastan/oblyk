<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestUser extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function contest()
    {
        return $this->hasOne('App\Contest', 'id', 'contest_id');
    }
}
