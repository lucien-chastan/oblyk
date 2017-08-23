<?php

namespace App\Http\Controllers;

use App\Article;
use App\Crag;
use App\Cross;
use App\Description;
use App\Gym;
use App\Photo;
use App\Route;
use App\Topo;
use App\TopoPdf;
use App\TopoWeb;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPage()
    {
        $articles = Article::where([['id','>','0'],['publish','=',1]])->withCount('descriptions')->orderBy('created_at','desc')->skip(0)->take(3)->get();
        $data = [
            'nb_crags' => Crag::count(),
            'nb_users' => User::count(),
            'nb_gyms' => Gym::count(),
            'nb_routes' => Route::count(),
            'nb_crosses' => Cross::count(),
            'nb_photos' => Photo::count(),
            'nb_videos' => Video::count(),
            'nb_topos' => Topo::count(),
            'nb_topos_web' => TopoWeb::count(),
            'nb_topos_pdf' => TopoPdf::count(),
            'nb_descriptions' => Description::count(),
            'articles' => $articles
        ];
        return view('pages.home.index', $data);
    }
}
