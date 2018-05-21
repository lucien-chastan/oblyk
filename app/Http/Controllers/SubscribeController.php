<?php

namespace App\Http\Controllers;

use App\Article;
use App\Crag;
use App\Cross;
use App\Description;
use App\Gym;
use App\Link;
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

class SubscribeController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function subscribePage(Request $request)
    {
        $this->validate($request, ['subscribe_mail' => 'email']);
        $email = $request->input('subscribe_mail');
        Subscriber::firstOrCreate(['email' => $email]);

        return view('pages.news-letter.subscribe', ['email' => $email]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function unsubscribePage(Request $request)
    {
        $this->validate($request, ['email' => 'email']);
        $email = $request->input('email');
        Subscriber::where('email',$request->input('email'))->delete();
        return view('pages.news-letter.unsubscribe', ['email' => $email]);
    }
}
