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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function photoModal(Request $request)
    {
        $Photo = Photo::class;

        //construction de la définition (vide ou avec des infos)
        $id_photo = $request->input('photo_id');
        $photo = isset($id_photo) ? $Photo::where('id', $id_photo)->first() : new Photo();
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
                'source' => $photo->source,
                'copyright_by' => $photo->copyright_by ?? true,
                'copyright_nc' => $photo->copyright_nc ?? true,
                'copyright_nd' => $photo->copyright_nd ?? true,
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $Album = Album::class;
        $Crag = Crag::class;
        $Sector = Sector::class;
        $Route = Route::class;
        $User = User::class;

        $mSize = config('app.photo_max_size');
        $mHeight = config('app.photo_max_height');
        $mWidth = config('app.photo_max_width');

        // Valid form
        $this->validate(
            $request,
            ['file' => "required|image|mimes:jpeg,png,jpg,gif,svg|max:$mSize|dimensions:max_width=$mWidth,max_height=$mHeight"]
        );

        $photo = new Photo();

        //si nous avons un fichier image
        if ($request->hasFile('file')) {
            try {

                //on va chercher l'album
                $album_id = 0;

                if ($request->input('album_id') != 0) {
                    $album_id = $request->input('album_id');
                } else {
                    $Albums = $Album::where('user_id', Auth::id())->get();
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

                $photo->illustrable_id = $request->input('illustrable_id');
                $photo->illustrable_type = $request->input('illustrable_type');
                $photo->source = $request->input('source');
                $photo->copyright_by = ($request->input('copyright_by') == 'true');
                $photo->copyright_nc = ($request->input('copyright_nc') == 'true');
                $photo->copyright_nd = ($request->input('copyright_nd') == 'true');
                $photo->slug_label = 'temp.jpg';
                $photo->user_id = Auth::id();
                $photo->album_id = $album_id;
                $photo->description = $request->input('description');
                $photo->save();

                //Photo d'une falaise
                if ($photo->illustrable_type == 'App\Crag') {
                    $type = $Crag::where('id', $photo->illustrable_id)->first();
                    $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
                }

                //Photo d'un secteur
                if ($photo->illustrable_type == 'App\Sector') {
                    $type = $Sector::where('id', $photo->illustrable_id)->first();
                    $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
                }

                //Photo d'un secteur
                if ($photo->illustrable_type == 'App\Route') {
                    $type = $Route::where('id', $photo->illustrable_id)->first();
                    $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
                }

                //Photo d'un user
                if ($photo->illustrable_type == 'App\User') {
                    $type = $User::where('id', Auth::id())->first();
                    $photo->slug_label = str_slug($type->label) . '-' . $photo->id . '.jpg';
                }

                $img = Image::make($request->file('file'));

                $photo->exif_model = $img->exif('Model');
                $photo->exif_make = $img->exif('Make');

                $photo->save();

                //Image en 1300px de large
                $img->orientate()
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

            } catch (Exception $e) {
                //s'il y a un problème on supprime les images potentiellement uploadé
                if (file_exists(storage_path('app/public/photos/crags/1300/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/1300/' . $photo->slug_label));
                if (file_exists(storage_path('app/public/photos/crags/200/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/200/' . $photo->slug_label));
                if (file_exists(storage_path('app/public/photos/crags/100/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/100/' . $photo->slug_label));
                if (file_exists(storage_path('app/public/photos/crags/50/' . $photo->slug_label))) unlink(storage_path('app/public/photos/crags/50/' . $photo->slug_label));

                //on supprime la photo en base de donnée
                $photo->delete();

                return response()->json($e->getMessage(), 500);

            } finally {
                // test if the upload is ok, otherwise delete the record
                if (!file_exists(storage_path('app/public/photos/crags/1300/' . $photo->slug_label))) $photo->delete();
            }
        }

        return response()->json(json_encode($photo));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Photo = Photo::class;
        $Album = Album::class;

        //enregistrement des données
        $photo = $Photo::where('id', $request->input('id'))->first();

        //on va chercher l'album
        $album_id = 0;
        if ($request->input('album_id') != 0) {
            $album_id = $request->input('album_id');
        } else {
            $Albums = $Album::where('user_id', Auth::id())->get();
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
            $photo->source = $request->input('source');
            $photo->copyright_by = $request->input('copyright_by');
            $photo->copyright_nc = $request->input('copyright_nc');
            $photo->copyright_nd = $request->input('copyright_nd');
            $photo->save();
        }

        return response()->json(json_encode($photo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $Photo = Photo::class;
        $Crag = Crag::class;

        $photo = $Photo::where('id', $id)->first();
        $savePhoto = $photo;

        if($photo->user_id == Auth::id()){

            //si c'était la photo par défaut du site, on remet à null
            $crags = $Crag::where('photo_id',$photo->id)->get();
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
