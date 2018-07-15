<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleCrag;
use App\Crag;

class ArticleController extends Controller
{

    public function articlePage($article_id){

        $article = Article::where('id', $article_id)
            ->with('descriptions')
            ->withCount('descriptions')
            ->with('articleCrags.crag')
            ->with('articleTopos.topo')
            ->with('enrichedAuthor')
            ->first();

        //bandeau de l'article
        $bandeau = file_exists(storage_path('app/public/articles/1300/article-' . $article->id . '.jpg')) ? '/storage/articles/1300/article-' . $article->id . '.jpg' : '/img/default-article-bandeau.jpg';

        $nbTopo = count($article->articleTopos);
        $nbCrag = count($article->articleCrags);

        //on ajoute une vue à l'article
        $article->views++;
        $article->save();

        return view('pages.article.article', [
            'meta_title' => $article->label,
            'meta_description' => $article->description,
            'article' => $article,
            'bandeau' => $bandeau,
            'nbTopo' => $nbTopo,
            'nbCrag' => $nbCrag,
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

    public function getArticleCrags ($article_id) {
        return response()->json(
            Crag::wherein(
                'id',
                ArticleCrag::where('article_id', $article_id)->select('crag_id')->get()->toArray()
            )->with('gapGrade')->get()
        );
    }

}
