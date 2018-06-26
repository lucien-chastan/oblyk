<?php

namespace App\Observers;

use App\Conversation;
use App\Message;
use App\UserConversation;

class ConversationObserver
{

    /**
     * @param Conversation $conversation
     */
    public function creating(Conversation $conversation) {
        $conversation->label = strip_tags($conversation->label);
    }

    /**
     * @param Conversation $conversation
     */
    public function updating(Conversation $conversation) {
        $conversation->label = strip_tags($conversation->label);
    }

    /**
     * Listen to the Conversation deleting event.
     *
     * @param Conversation $conversation
     * @return void
     * @throws \Exception
     */
    public function deleting(Conversation $conversation)
    {
        UserConversation::where('conversation_id', $conversation->id)->delete();
        Message::where('conversation_id', $conversation->id)->delete();
    }
}