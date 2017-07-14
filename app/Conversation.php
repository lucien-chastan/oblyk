<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    public function userConversations(){
        return $this->hasMany('App\UserConversation','conversation_id', 'id');
    }

    public function messages(){
        return $this->hasMany('App\Message','conversation_id', 'id');
    }

}