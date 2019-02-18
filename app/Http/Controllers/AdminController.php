<?php

namespace App\Http\Controllers;

use App\Article;
use App\Exception;
use App\Help;
use App\Newsletter;
use App\Route;
use App\Sector;

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

    //ROUTE
    public function sectorInformationPage(){
        return view('pages.admin.sector.information');
    }

    public function getSectorInformation($sector_id){

        $sector = Sector::where('id', $sector_id)
            ->with('crag')
            ->with('routes')
            ->with('user')
            ->with('descriptions.user')
            ->with('photos.user')
            ->first();

        $data = [
            'sector' => $sector,
        ];

        return view('pages.admin.sector.get-information', $data);

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


    //LES AIDES
    public function createHelpPage(){
        return view('pages.admin.helps.create-help');
    }

    public function updateHelpPage(){
        return view('pages.admin.helps.edit-help');
    }

    public function deleteHelpPage(){
        return view('pages.admin.helps.delete-help');
    }

    public function getHelpInformation($help_id){

        $help = Help::where('id', $help_id)->first();

        $data = [
            'help' => $help,
        ];

        return view('pages.admin.helps.get-help', $data);

    }

    //LES EXCEPTIONS
    public function createExceptionPage(){
        return view('pages.admin.exceptions.create-exception');
    }

    public function updateExceptionPage(){
        return view('pages.admin.exceptions.edit-exception');
    }

    public function deleteExceptionPage(){
        return view('pages.admin.exceptions.delete-exception');
    }

    public function getExceptionInformation($exception_id){

        $exception = Exception::where('id', $exception_id)->first();

        $data = [
            'exception' => $exception,
        ];

        return view('pages.admin.exceptions.get-exception', $data);

    }

    // NEWS LETTER
    public function createNewsletterPage(){
        return view('pages.admin.newsletter.create-newsletter');
    }

    public function updateNewsletterPage(){
        return view('pages.admin.newsletter.update-newsletter');
    }

    public function getNewsletterInformation($newsletter_ref){

        $newsletter = Newsletter::where('ref', $newsletter_ref)->first();

        $data = [
            'newsletter' => $newsletter,
        ];

        return view('pages.admin.newsletter.get-newsletter', $data);

    }
}
