<?php

namespace App\Http\Controllers\CRUD;

use App\Article;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Mockery\Exception;



class ArticleController extends Controller
{


    //Upload du bandeau et du logo
    function uploadBandeauArticle (Request $request){

        //validation du formulaire
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        $article = Article::where('id', $request->input('id'))->first();

        //Upload du bandeau
        if ($request->hasFile('bandeau')) {

            try {
                //Bandeau en 1300px de large
                $img = Image::make($request->file('bandeau'))
                    ->orientate()
                    ->resize(1300, null, function ($constraint) {$constraint->aspectRatio();})
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/articles/1300/article-' . $article->id . '.jpg'));

                //Bandeau en 200px de haut
                $img->resize(null, 200, function ($constraint) {$constraint->aspectRatio();})
                    ->save(storage_path('app/public/articles/200/article-' . $article->id . '.jpg'));

                //Crop de l'image en 100 * 100
                $img->fit(100, 100)->save(storage_path('app/public/articles/100/article-' . $article->id . '.jpg'));

                //Crop de l'image en 50 * 50
                $img->fit(50, 50)->save(storage_path('app/public/articles/50/article-' . $article->id . '.jpg'));

            }catch (Exception $e){

                //s'il y a un problème on supprime les images potentiellement uploadé
                if(file_exists(storage_path('app/public/articles/1300/article-' . $article->id . '.jpg'))) unlink(storage_path('pp/public/articles/1300/article-' . $article->id . '.jpg'));
                if(file_exists(storage_path('app/public/articles/200/article-' . $article->id . '.jpg'))) unlink(storage_path('pp/public/articles/200/article-' . $article->id . '.jpg'));
                if(file_exists(storage_path('app/public/articles/100/article-' . $article->id . '.jpg'))) unlink(storage_path('pp/public/articles/100/article-' . $article->id . '.jpg'));
                if(file_exists(storage_path('app/public/articles/50/article-' . $article->id . '.jpg'))) unlink(storage_path('pp/public/articles/50/article-' . $article->id . '.jpg'));

            }
        }

        return redirect()->route('articlePage', ['article_id'=>$article->id, 'article_label'=>str_slug($article->label)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //see modal controller
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'label' => 'required|max:255',
            'description' => 'required',
            'body' => 'required',
            'author' => 'required',
        ]);

        //enregistrement des données
        $article = new Article();
        $article->label = $request->input('label');
        $article->description = $request->input('description');
        $article->body = $request->input('body');
        $article->author = $request->input('author');
        $article->views = 0;
        $article->publish = 0;
        $article->save();

        return redirect()->route('articlePage', ['article_id'=>$article->id, 'article_label'=>str_slug($article->label)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //see modal controller
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validation du formulaire
        $this->validate($request, [
            'label' => 'required|max:255',
            'description' => 'required',
            'body' => 'required',
            'author' => 'required',
            'id' => 'required',
        ]);

        //enregistrement des données
        $article = Article::where('id', $request->input('id'))->first();
        $article->label = $request->input('label');
        $article->description = $request->input('description');
        $article->body = $request->input('body');
        $article->author = $request->input('author');
        $article->views = $request->input('views');
        $article->publish = $request->input('publish');
        $article->save();

        return response()->json(json_encode($article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
