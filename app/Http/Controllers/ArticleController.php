<?php

namespace App\Http\Controllers;

use App\Article;

class ArticleController extends Controller
{

    public function articlePage($article_id){

        $article = Article::where('id', $article_id)
            ->with('descriptions')
            ->withCount('descriptions')
            ->with('articleCrags.crag')
            ->with('articleTopos.topo')
            ->first();

        //bandeau de l'article
        $bandeau = file_exists(storage_path('app/public/articles/1300/article-' . $article->id . '.jpg')) ? '/storage/articles/1300/article-' . $article->id . '.jpg' : '/img/default-article-bandeau.jpg';

        //on ajoute une vue à l'article
        $article->views++;
        $article->save();

        return view('pages.article.article', [
            'meta_title' => $article->label,
            'meta_description' => $article->description,
            'article' => $article,
            'bandeau' => $bandeau
        ]);
    }

    public function articlesPage() {

        $articles = Article::where('publish',1)
            ->orderBy('created_at', 'DESC')
            ->withCount('descriptions')
            ->paginate(5);

        return view('pages.article.articles', [
            'articles' => $articles
        ]);
    }

}
