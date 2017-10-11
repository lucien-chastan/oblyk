<?php

namespace App\Http\Controllers\CRUD;

use App\Album;
use App\Crag;
use App\Photo;
use App\Route;
use App\Sector;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function photoModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_photo = $request->input('photo_id');
        $photo = isset($id_photo) ? Photo::where('id', $id_photo)->first() : new Photo();
        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';


        //définition du chemin de sauvgarde
        if (($request->input('method') == 'POST')) {
            $outputRoute = '/photos';
            $submitFunction = 'uploadPhoto';
        } else {
            $outputRoute = '/photos/' . $id_photo;
            $submitFunction = 'submitData';
        }

        $data = [
            'dataModal' => [
                'illustrable_id' => $request->input('illustrable_id'),
                'illustrable_type' => "App\\" . $request->input('illustrable_type'),
                'slug_label' => $photo->slug_label,
                'description' => $photo->description,
                'album_id' => $photo->album_id,
                'id' => $id_photo,
                'submit' => $submitFunction,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'callback' => $callback,
                'route' => $outputRoute
            ]
        ];

        return view('modal.photo', $data);
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
            'file' => 'required|image:jpeg,jpg,png|file|max:10240|dimensions:max_width=4000,max_height=4000',
        ]);

        //si nous avons un fichier image
        if ($request->hasFile('file')) {

            //on va chercher l'album
            $album_id = 0;
            if ($request->input('album_id') != 0) {
                $album_id = $request->input('album_id');
            } else {
                $Albums = Album::where('user_id', Auth::id())->get();
                $mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                $newAlbumName = $mois[date('n') - 1] . ' ' . date('Y');
                $trouver = false;

                foreach ($Albums as $album) {
                    if ($newAlbumName == $album->label) {
                        $trouver = true;
                        $album_id = $album->id;
                    }
                }

                if (!$trouver) {
                    $album = new Album();
                    $album->label = $newAlbumName;
                    $album->description = '';
                    $album->user_id = Auth::id();
                    $album->save();
                    $album_id = $album->id;
                }
            }

            $photo = new Photo();
            $photo->illustrable_id = $request->input('illustrable_id');
            $photo->illustrable_type = $request->input('illustrable_type');
            $photo->slug_label = 'temp.jpg';
            $photo->user_id = Auth::id();
            $photo->album_id = $album_id;
            $photo->description = $request->input('description');
            $photo->save();

            //Photo d'une falaise
            if ($photo->illustrable_type == 'App\Crag') {
                $type = Crag::where('id', $photo->illustrable_id)->first();
                $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
            }

            //Photo d'un secteur
            if ($photo->illustrable_type == 'App\Sector') {
                $type = Sector::where('id', $photo->illustrable_id)->first();
                $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
            }

            //Photo d'un secteur
            if ($photo->illustrable_type == 'App\Route') {
                $type = Route::where('id', $photo->illustrable_id)->first();
                $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
            }

            //Photo d'un user
            if ($photo->illustrable_type == 'App\User') {
                $type = User::where('id', Auth::id())->first();
                $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
            }

            //on réenregistre le slug_label de la photo
            $photo->save();

            try {
                //Image en 1300px de large
                $img = Image::make($request->file('file'))
                    ->orientate()
                    ->resize(1300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/photos/crags/1300/' . $photo->slug_label));

                //copie pour image en 200 de haut
                $img200 = $img;

                //Image en 200px de haut
                $img200->resize(null, 200, function ($constraint) {$constraint->aspectRatio();})
                    ->save(storage_path('app/public/photos/crags/200/' . $photo->slug_label));

                //Crop de l'image en 100 * 100
                $img->fit(100, 100)->save(storage_path('app/public/photos/crags/100/' . $photo->slug_label));

                //Crop de l'image en 50 * 50
                $img->fit(50, 50)->save(storage_path('app/public/photos/crags/50/' . $photo->slug_label));

                return response()->json(json_encode($photo));

            }catch (Exception $e){

                //s'il y a un problème on supprime les images potentiellement uploadé
                if(file_exists(storage_path('app/public/photos/crags/1300/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/1300/' . $photo->slug_label));
                if(file_exists(storage_path('app/public/photos/crags/200/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/200/' . $photo->slug_label));
                if(file_exists(storage_path('app/public/photos/crags/100/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/100/' . $photo->slug_label));
                if(file_exists(storage_path('app/public/photos/crags/50/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/50/' . $photo->slug_label));

                //on supprime la photo en base de donnée
                $photo->delete();

                return response()->json($e, 400);

            }
        }
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
        //enregistrement des données
        $photo = Photo::where('id', $request->input('id'))->first();

        //on va chercher l'album
        $album_id = 0;
        if ($request->input('album_id') != 0) {
            $album_id = $request->input('album_id');
        } else {
            $Albums = Album::where('user_id', Auth::id())->get();
            $mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            $newAlbumName = $mois[date('n') - 1] . ' ' . date('Y');
            $trouver = false;

            foreach ($Albums as $album) {
                if ($newAlbumName == $album->label) {
                    $trouver = true;
                    $album_id = $album->id;
                }
            }

            if (!$trouver) {
                $album = new Album();
                $album->label = $newAlbumName;
                $album->description = '';
                $album->user_id = Auth::id();
                $album->save();
                $album_id = $album->id;
            }
        }

        if($photo->user_id == Auth::id()){
            $photo->description = $request->input('description');
            $photo->album_id = $album_id;
            $photo->save();
        }

        return response()->json(json_encode($photo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $photo = Photo::where('id', $id)->first();
        $savePhoto = $photo;

        if($photo->user_id == Auth::id()){

            //si c'était la photo par défaut du site, on remet à null
            $crags = Crag::where('photo_id',$photo->id)->get();
            foreach ($crags as $crag){
                $crag->photo_id = null;
                $crag->save();
            }

            //suppression des photos dans le storage
            Storage::delete([
                'public/photos/crags/50/' . $photo->slug_label,
                'public/photos/crags/100/' . $photo->slug_label,
                'public/photos/crags/200/' . $photo->slug_label,
                'public/photos/crags/1300/' . $photo->slug_label
            ]);

            $photo->delete();
        }

        return response()->json(json_encode($savePhoto));
    }
}
