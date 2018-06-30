<?php

namespace App\Http\Controllers;

use App\Article;
use App\Crag;
use App\ForumTopic;
use App\Gym;
use App\Route;
use App\Topo;
use App\User;
use App\Word;

class sitemapController extends Controller
{
    private $languages = ['fr','en'];

    public function sitemapIndex() {

        $lastUser = User::orderBy('created_at', 'DESC')->first();
        $lastCrag = Crag::orderBy('created_at', 'DESC')->first();
        $lastTopo = Topo::orderBy('created_at', 'DESC')->first();
        $lastGym = Gym::orderBy('created_at', 'DESC')->first();
        $lastTopic = ForumTopic::orderBy('created_at', 'DESC')->first();

        return view('sitemaps.sitemap-index', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'lastUser' => $lastUser,
            'lastCrag' => $lastCrag,
            'lastTopo' => $lastTopo,
            'lastGym' => $lastGym,
            'lastTopic' => $lastTopic,
        ]);
    }

    public function sitemapCommon() {
        $lastArticle = Article::where('publish',1)->OrderBy('created_at', 'DESC')->first();
        $articles = Article::all();
        $lastWors = Word::OrderBy('created_at', 'DESC')->first();
        $lastCrag = Crag::OrderBy('created_at', 'DESC')->first();
        $lastGym = Gym::OrderBy('created_at', 'DESC')->first();

        return view('sitemaps.sitemap-common', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'lastArticles' => $lastArticle->created_at,
            'lastWord' => $lastWors->created_at,
            'lastCrag' => $lastCrag->created_at,
            'lastGym' => $lastGym->created_at,
            'articles' => $articles
        ]);
    }

    public function sitemapClimbers() {
        $climbers = User::all();
        return view('sitemaps.sitemap-climbers', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'climbers' => $climbers,
        ]);
    }

    public function sitemapCrags() {
        $crags = Crag::all();
        return view('sitemaps.sitemap-crags', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'crags' => $crags,
        ]);
    }

    public function sitemapCragRoutes($crag_id) {
        $crag = Crag::find($crag_id);
        $routes = Route::where('crag_id', $crag_id)->get();
        $photos = $crag->allPhoto();

        return view('sitemaps.sitemap-crag-routes', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'crag' => $crag,
            'routes' => $routes,
            'photos' => $photos,
        ]);
    }

    public function sitemapTopos() {
        $topos = Topo::all();
        return view('sitemaps.sitemap-topos', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'topos' => $topos,
        ]);
    }

    public function sitemapGyms() {
        $gyms = Gym::all();
        return view('sitemaps.sitemap-gyms', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'gyms' => $gyms,
        ]);
    }

    public function sitemapTopics() {
        $topics = ForumTopic::all();
        return view('sitemaps.sitemap-topics', [
            'app' => env('APP_URL'),
            'languages' => $this->languages,
            'topics' => $topics,
        ]);
    }
}
