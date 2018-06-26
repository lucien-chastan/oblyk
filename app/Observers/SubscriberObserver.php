<?php

namespace App\Observers;


use App\Subscriber;

class SubscriberObserver
{

    /**
     * @param Subscriber $subscriber
     */
    public function creating(Subscriber $subscriber) {
        $subscriber->email = strip_tags($subscriber->email);
    }

    /**
     * @param Subscriber $subscriber
     */
    public function updating(Subscriber $subscriber) {
        $subscriber->email = strip_tags($subscriber->email);
    }

}