<?php

namespace App\Observers;


use App\Exception;

class ExceptionObserver
{

    /**
     * @param Exception $exception
     */
    public function creating(Exception $exception) {
        $exception->description = clean($exception->description);
    }

    /**
     * @param Exception $exception
     */
    public function updating(Exception $exception) {
        $exception->description = clean($exception->description);
    }

}