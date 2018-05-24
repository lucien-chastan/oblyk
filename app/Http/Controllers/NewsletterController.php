<?php

namespace App\Http\Controllers;

use App\Article;
use App\Crag;
use App\Cross;
use App\Description;
use App\Gym;
use App\Link;
use App\Mail\sendSubscribeNewsletter;
use App\Mail\sendUnsubscribeNewsletter;
use App\Newsletter;
use App\Photo;
use App\Route;
use App\Subscriber;
use App\Topo;
use App\TopoPdf;
use App\TopoWeb;
use App\User;
use App\Video;
use App\Word;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
    public function newsletterPage(string $ref)
    {
        $newsletter = Newsletter::where('ref', $ref)->first();
        return view('pages.news-letter.news-letter', ['newsletter' => $newsletter]);
    }
}
