<?php

namespace App\Http\Controllers\CRUD;

use App\Comment;
use App\ForumTopic;
use App\Notification;
use App\Post;
use App\PostPhoto;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function postModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_post = $request->input('post_id');
        $post = isset($id_post) ? Post::where('id', $id_post)->first() : new Post();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/posts' : '/posts/' . $id_post;

        $data = [
            'dataModal' => [
                'postable_id' => $request->input('postable_id'),
                'postable_type' => "App\\" . $request->input('postable_type'),
                'content' => $post->content,
                'id' => $id_post,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.post', $data);
    }


    //Upload d'une photo dans une actualité
    function uploadPostImage(Request $request){

        if ($request->hasFile('fileToUpload')) {

            $post_photo = new PostPhoto();
            $post_photo->description = $request->input('alt');
            $post_photo->slug_label = 'temp.jpg';
            $post_photo->user_id = Auth::id();
            $post_photo->save();

            $post_photo->slug_label = 'post-photo-' . $post_photo->id . '.jpg';
            $post_photo->save();

            //Image en 800px de large
            Image::make($request->file('fileToUpload'))
                ->orientate()
                ->resize(800, null, function ($constraint) {$constraint->aspectRatio();})
                ->encode('jpg', 70)
                ->save(storage_path('app/public/post-photos/' . $post_photo->slug_label));

            //retourne les valeurs
            $data = [
                'success' => true,
                'file' => '/storage/post-photos/' . $post_photo->slug_label
            ];


        }else{
            $data = array(
                'success' => false,
                'message' => 'Vous n\'avez pas envoyé de photo',
            );
        }

        return response()->json($data);

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
            'postable_id' => 'required|Integer',
            'postable_type' => 'required|String',
            'trumbowyg-post-editor' => 'required',
        ]);

        $content = str_replace("&lt;script&gt;", '', $request->input('trumbowyg-post-editor'));
        $content = str_replace("&lt;/script&gt;", '', $content);

        //enregistrement des données
        $post = new Post();
        $post->postable_id = $request->input('postable_id');
        $post->postable_type = $request->input('postable_type');
        $post->content = $content;
        $post->user_id = Auth::id();
        $post->save();

        //on va chercher les post_photos qui on 0 dans post_id pour les attribuer à ce post
        $post_photos = PostPhoto::where([['user_id', Auth::id()],['post_id',0]])->get();
        foreach ($post_photos as $photo){
            $photo->post_id = $post->id;
            $photo->save();
        }

        //Si c'est un post sur le forum, alors on ajoute +1 au nombre de vu du topic et on rafraichi sa dernière lecture
        if($post->postable_type == 'App\ForumTopic'){
            $topic = ForumTopic::where('id',$post->postable_id)->first();
            $topic->nb_post = $topic->nb_post + 1;
            $topic->last_post = Carbon::now();
            $topic->save();

            $user = User::where('id',Auth::id())->first();

            //on notifi l'auteur du sujet
            if($topic->user_id != $post->user_id){
                $notification = new Notification();
                $notification->type = 'new_post_in_forum';
                $notification->user_id = $topic->user_id;
                $notification->data = Notification::jsonData(
                    'new_post_in_forum',
                    [$user->name,$topic->label],
                    '/img/forum-' . $topic->category_id . '.svg',
                    [route('userPage',['user_id'=>$user->id,'user_label'=>str_slug($user->name)]),$user->name],
                    [$topic->id]
                );
                $notification->save();
            }
        }

        return response()->json(json_encode($post));

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
            'postable_id' => 'required|Integer',
            'postable_type' => 'required|String',
            'trumbowyg-post-editor' => 'required',
        ]);

        $content = str_replace("&lt;script&gt;", '', $request->input('trumbowyg-post-editor'));
        $content = str_replace("&lt;/script&gt;", '', $content);

        //enregistrement des données
        $post = Post::where('id', $request->input('id'))->first();
        if($post->user_id == Auth::id()){
            $post->content = $content;
            $post->save();
        }

        //on va chercher les post_photos qui on 0 dans post_id pour les attribuer à ce post
        $post_photos = PostPhoto::where([['user_id', Auth::id()],['post_id',0]])->get();
        foreach ($post_photos as $photo){
            $photo->post_id = $post->id;
            $photo->save();
        }

        return response()->json(json_encode($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->with('likes')->with('comments.likes')->with('comments.comments.likes')->first();

        if($post->user_id == Auth::id()){

            //loop sur les commentaires de premier niveau
            foreach ($post->comments as $comment){

                //loop sur les commentaire de deuxième niveau
                foreach ($comment->comments as $subComment) {

                    //suppresion des likes deuxièmes niveau
                    foreach ($subComment->likes as $subLike) $subLike->delete();

                    //suppression du commentaire de deuxième niveau
                    $subComment->delete();

                }

                //suppresion des likes premier niveau
                foreach ($comment->likes as $comLike) $comLike->delete();

                //suppression du commentaire premier niveau
                $comment->delete();
            }

            //suppression des likes du post
            foreach ($post->likes as $postLike) $post->delete();

            //on va supprimer les photos liées
            $post_photos = PostPhoto::where('post_id',$post->id)->get();
            foreach ($post_photos as $photo){
                Storage::delete(['public/post-photos/' . $photo->slug_label]);
                $photo->delete();
            }

            //Si c'est un post sur le forum, alors on enleve -1 au nombre de vu du topic et on rafraichi sa dernière lecture
            if($post->postable_type == 'App\ForumTopic'){
                $topic = ForumTopic::where('id',$post->postable_id)->first();
                $topic->nb_post = $topic->nb_post - 1;
                $topic->save();
            }

            //suppression du post
            $post->delete();
        }
    }
}
