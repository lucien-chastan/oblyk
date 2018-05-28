<?php

namespace App\Http\Controllers;

use App\Mail\sendNewsletter;
use App\Newsletter;
use App\Subscriber;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $ref
     * @return \Illuminate\Http\Response
     */
    public function newsletterPage($ref)
    {
        $newsletter = Newsletter::where('ref', $ref)->first();
        return view('pages.news-letter.news-letter', ['newsletter' => $newsletter]);
    }

    /**
     * @param string $ref
     */
    public function sendNewsletter($ref)
    {
        $newsletter = Newsletter::where('ref', $ref)->first();
        $subscribers = Subscriber::where([['send','=',false],['error', '<' , '3']])->limit(env('MAILING_LOT'))->get();
        $newsletterTitle = 'Oblyk #' . str_replace('-','.', $newsletter->ref) . ' ' . $newsletter->title;
        $onlineRoute = route('newsletter', ['ref' => $newsletter->ref]);
        $unsubscribeRoute = route('unsubscribe');

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new sendNewsletter(
                    [
                        'title' => $newsletterTitle,
                        'newsletter' => $newsletter,
                        'email' => $subscriber->email,
                        'onlineRoute' => $onlineRoute,
                        'unsubscribeRoute' => $unsubscribeRoute . '?email=' . $subscriber->email,
                    ]
                ));
                $subscriber->send = true;
                $subscriber->save();
            } catch (\Exception $ex) {
                $subscriber->send = true;
                $subscriber->error++;
                $subscriber->save();
            }
        }
    }
}
