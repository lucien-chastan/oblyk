<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function galleryPage(Request $request, $photo_id){
        $photo = Photo::where('id', $photo_id)->with('user')->first();
        $collectionPhotos = [];
        $next = null;
        $last = null;
        $currentIndex = null;
        $photo->getLatLng();

        if($request->has('photos')) {
            $photos = explode(',', $request->input('photos'));
            array_map(
                function ($photo_id) {return (int)$photo_id;},
                $photos
            );
            if($photos > 0) {
                $currentIndex = array_search($photo_id, $photos);
                $next = $photos[$currentIndex + 1] ?? null;
                $last = $photos[$currentIndex - 1] ?? null;
                $queryCollection = [];
                $collectionPhotos = Photo::wherein('id', $photos)->orderBy('created_at')->get();
                foreach ($collectionPhotos as $collectionPhoto) {
                    $queryCollection[] = $collectionPhoto->id;
                }
                $queryCollection = '?photos=' . join(',',$queryCollection);
            }
        }

        $data = [
            'photo' => $photo,
            'photos' => $collectionPhotos,
            'next' => $next,
            'last' => $last,
            'current' => $currentIndex,
            'element' => $photo->getTargetLink()['element'],
            'queryCollection' => $queryCollection ?? ''
        ];

        return view('pages.gallery.gallery', $data);
    }
}
