<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function articlePage($article_id, $article_label){

        $article = Article::where('id', $article_id)->with('descriptions')->withCount('descriptions')->first();

        //bandeau de l'article
        $bandeau = file_exists(storage_path('app/public/articles/1300/article-' . $article->id . '.jpg')) ? '/storage/articles/1300/article-' . $article->id . '.jpg' : '/img/default-article-bandeau.jpg';

        //on ajoute une vue à l'article
        $article->views++;
        $article->save();

        $data = [
            'meta_title' => $article->label,
            'meta_description' => $article->description,
            'article' => $article,
            'bandeau' => $bandeau
            ];
        return view('pages.article.article', $data);
    }

}
