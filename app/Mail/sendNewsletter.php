<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $newsletter = $this->data['newsletter'];
        $email = $this->data['email'];

        return $this->subject('Oblyk #' . str_replace('-','.', $newsletter->ref) . ' ' . $newsletter->title)->markdown('mails.newsletter')->with(
            [
                'newsletter'=>$newsletter,
                'email' => $email
            ]
        );
    }
}
