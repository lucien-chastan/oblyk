<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConversation extends Model
{

    public function conversation(){
        return $this->hasOne('App\Conversation','id', 'conversation_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

}