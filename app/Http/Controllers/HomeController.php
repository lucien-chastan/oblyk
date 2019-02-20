<?php

namespace App\Http\Controllers;

use App\Article;
use App\Crag;
use App\Cross;
use App\Description;
use App\Gym;
use App\IndoorCross;
use App\Link;
use App\Photo;
use App\Route;
use App\Topo;
use App\TopoPdf;
use App\TopoWeb;
use App\User;
use App\Video;
use App\Word;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPage()
    {
        $articles = Article::where([['id','>','0'],['publish','=',1]])->withCount('descriptions')->orderBy('created_at','desc')->skip(0)->take(3)->get();

        $activity = [
            'crags' => Crag::where('created_at','>=', Carbon::yesterday())->get(),
            'routes' => Route::where('created_at','>=', Carbon::yesterday())->with('routeSections')->get(),
            'climbers' => User::where('created_at','>=', Carbon::yesterday())->get(),
            'topos' => Topo::where('created_at','>=', Carbon::yesterday())->get(),
            'toposPdf' => TopoPdf::where('created_at','>=', Carbon::yesterday())->with('crag')->get(),
            'toposWeb' => TopoWeb::where('created_at','>=', Carbon::yesterday())->with('crag')->get(),
            'photos' => Photo::where('created_at','>=', Carbon::yesterday())->get(),
            'videos' => Video::where('created_at','>=', Carbon::yesterday())->get(),
            'links' => Link::where('created_at','>=', Carbon::yesterday())->get(),
            'gyms' => Gym::where('created_at','>=', Carbon::yesterday())->get(),
            'words' => Word::where('created_at','>=', Carbon::yesterday())->get(),
        ];

        $activityCount =
            count($activity['crags']) + count($activity['routes']) + count($activity['climbers']) + count($activity['topos'])
            + count($activity['toposPdf']) + count($activity['toposWeb']) + count($activity['toposWeb']) + count($activity['photos'])
            + count($activity['videos']) + count($activity['links']) + count($activity['gyms']) + count($activity['words']);

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
            'nb_indoor_crosses' => IndoorCross::count(),
            'nb_indoor_crosses_today' => IndoorCross::where('created_at','>=',date('Y-m-d'))->count(),
            'articles' => $articles,
            'activity' => $activity,
            'countActivity' => $activityCount,
        ];
        return view('pages.home.index', $data);
    }
}
