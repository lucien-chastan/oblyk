<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    public function userConversations(){
        return $this->hasMany('App\UserConversation','conversation_id', 'id');
    }

}