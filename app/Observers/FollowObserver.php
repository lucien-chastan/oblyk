<?php

namespace App\Observers;

use App\Conversation;
use App\Follow;
use App\Message;
use App\UserConversation;

class FollowObserver
{

    /**
     * Listen to the UserConversation deleting event.
     *
     * @param Follow $follow
     * @return void
     */
    public function deleting(Follow $follow)
    {
        Follow::where([
            ['followed_id', '=', $follow->id],
            ['followed_type', '=' , 'App\User'],
        ])->delete();
    }
}