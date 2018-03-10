<?php

namespace App\Observers;

use App\Conversation;
use App\Message;
use App\UserConversation;

class UserConversationObserver
{

    /**
     * Listen to the UserConversation deleting event.
     *
     * @param UserConversation $UserConversation
     * @return void
     */
    public function deleting(UserConversation $UserConversation)
    {
        Conversation::where('id', $UserConversation->conversation_id)->get()->each(function($conversation) { $conversation->delete();});
    }
}