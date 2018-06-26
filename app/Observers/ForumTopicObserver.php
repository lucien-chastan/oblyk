<?php

namespace App\Observers;


use App\ForumTopic;

class ForumTopicObserver
{

    /**
     * @param ForumTopic $topic
     */
    public function creating(ForumTopic $topic) {
        $topic->label = strip_tags($topic->label);
    }

    /**
     * @param ForumTopic $topic
     */
    public function updating(ForumTopic $topic) {
        $topic->label = strip_tags($topic->label);
    }

}