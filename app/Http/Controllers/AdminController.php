<?php

namespace App\Http\Controllers;

use App\Article;
use App\Route;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function homePage(){
        return view('pages.admin.home');
    }


    //SAE
    public function uploadSaePage(){
        return view('pages.admin.sae.upload');
    }

    //ROUTE
    public function routeInformationPage(){
        return view('pages.admin.route.information');
    }

    public function getRouteInformation($route_id){

        $route = Route::where('id', $route_id)
            ->with('crag')
            ->with('sector')
            ->with('user')
            ->with('routeSections')
            ->with('crosses.user')
            ->with('tickLists.user')
            ->with('descriptions.user')
            ->with('videos.user')
            ->with('photos.user')
            ->with('tags')
            ->first();

        $data = [
            'route' => $route,
        ];

        return view('pages.admin.route.get-information', $data);

    }

    //ARTICLE
    public function uploadArticleBandeauPage(){
        return view('pages.admin.article.upload');
    }

    public function createArticlePage(){
        return view('pages.admin.article.create-article');
    }

    public function updateArticlePage(){
        return view('pages.admin.article.update-article');
    }

    public function getArticleInformation($article_id){

        $article = Article::where('id', $article_id)->first();

        $data = [
            'article' => $article,
        ];

        return view('pages.admin.article.get-article', $data);

    }

    //ELASTIC SEARCH
    public function ElasticIndexPage(){
        return view('pages.admin.elastic.index-page');
    }
}
