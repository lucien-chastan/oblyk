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
            'nb_crags_today' => Crag::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_users' => User::count(),
            'nb_users_today' => User::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_gyms' => Gym::count(),
            'nb_gyms_today' => Gym::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_routes' => Route::count(),
            'nb_routes_today' => Route::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_crosses' => Cross::count(),
            'nb_crosses_today' => Cross::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_photos' => Photo::count(),
            'nb_photos_today' => Photo::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_videos' => Video::count(),
            'nb_videos_today' => Video::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_topos' => Topo::count(),
            'nb_topos_today' => Topo::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_topos_web' => TopoWeb::count(),
            'nb_topos_web_today' => TopoWeb::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_topos_pdf' => TopoPdf::count(),
            'nb_topos_pdf_today' => TopoPdf::where('created_at','>=',date('Y-m-d'))->count(),
            'nb_descriptions' => Description::count(),
            'nb_descriptions_today' => Description::where('created_at','>=',date('Y-m-d'))->count(),
            'articles' => $articles
        ];
        return view('pages.home.index', $data);
    }
}
