<?php

namespace App\Http\Controllers\AdminCRUD;

use App\Crag;
use App\Route;
use App\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RouteCRUDController extends Controller
{

    public function deleteRoute($route_id){

        $route = Route::where('id', $route_id)
            ->with('routeSections')
            ->with('crosses.crossSections')
            ->with('crosses.crossUsers')
            ->with('tickLists')
            ->with('descriptions')
            ->with('videos')
            ->with('photos')
            ->with('tags')
            ->with('search')
            ->first();

        $crag_id = $route->crag_id;
        $sector_id = $route->sector_id;

        foreach ($route->crosses as $cross){
            foreach ($cross->crossSections as $section) $section->delete();
            foreach ($cross->crossUsers as $userCross) $userCross->delete();
            $cross->delete();
        }
        foreach ($route->routeSections as $section) $section->delete();
        foreach ($route->tickLists as $tick) $tick->delete();
        foreach ($route->descriptions as $description) $description->delete();
        foreach ($route->videos as $video) $video->delete();
        foreach ($route->photos as $photo) $photo->delete();
        foreach ($route->tags as $tag) $tag->delete();

        $route->search->delete();
        $route->delete();

        //Mise à jour des informations de la falaise
        Crag::majInformation($crag_id);

        //Mise à jour des informations de la falaise
        Sector::majInformation($sector_id);

        return back();

    }

}
