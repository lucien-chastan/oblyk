<?php

namespace App\Observers;

use App\Message;

class MessageObserver
{

    /**
     * @param Message $message
     */
    public function creating(Message $message) {
        $message->message = clean($message->message);
    }

    /**
     * @param Message $message
     */
    public function updating(Message $message) {
        $message->message = clean($message->message);
    }
}