<?php

namespace App\Observers;

use App\Conversation;
use App\Message;
use App\UserConversation;

class ConversationObserver
{

    /**
     * Listen to the Conversation deleting event.
     *
     * @param Conversation $conversation
     * @return void
     */
    public function deleting(Conversation $conversation)
    {
        UserConversation::where('conversation_id', $conversation->id)->delete();
        Message::where('conversation_id', $conversation->id)->delete();
    }
}