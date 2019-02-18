<?php

namespace App\Http\Controllers\Vue;

use App\Crag;
use App\Orientation;
use App\Photo;
use App\Season;
use App\Sector;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CragVueController extends Controller
{
    function vueMap($id){

        $crag = Crag::where('id',$id)
            ->with('parkings')
            ->with('approaches')
            ->first();

        $data = ['crag' => $crag];
        return view('pages.crag.vues.mapVue', $data);
    }

    function vueFilActu($id){
        $data = [
            'crag' => Crag::where('id', $id)->first()
        ];
        return view('pages.crag.vues.filActuVue',$data);
    }

    function vueMedias($id){

        $crag = Crag::where('id', $id)
            ->with('photos')
            ->with('sectors.photos')
            ->with('routes.photos')
            ->with('videos')
            ->with('videos.user')
            ->first();

        $photos = $crag->allPhoto();

        $nbPhoto = count($crag->photos);
        foreach ($crag->sectors as $sector) $nbPhoto += count($sector->photos);
        foreach ($crag->routes as $route) $nbPhoto += count($route->photos);

        $crag->nbPhoto = $nbPhoto;

        $data = [
            'crag' => $crag,
            'cragPhotos' => $photos
        ];

        return view('pages.crag.vues.mediasVue', $data);
    }

    function vueLiens($id){
        $data = [
            'crag' => Crag::where('id',$id)->with('links.user')->first()
        ];
        return view('pages.crag.vues.liensVue', $data);
    }

    function vueTopos($id){
        $data = [
            'crag' => Crag::where('id',$id)->with('topos.topo.user')->with('topoWebs.user')->with('topoPdfs.user')->first()
        ];
        return view('pages.crag.vues.toposVue', $data);
    }

    function vueSecteur($id){
        $data = [
            'sectors' => Sector::where('crag_id',$id)
                ->with('sun')
                ->with('rain')
                ->with('orientation')
                ->withCount('routes')
                ->withCount('descriptions')
                ->withCount('photos')
                ->withCount('versions')
                ->with('gapGrade')
                ->with('season')
                ->orderBy('label')
                ->get(),
            'crag' => Crag::where('id',$id)->first()
        ];
        return view('pages.crag.vues.secteurVue', $data);
    }
}