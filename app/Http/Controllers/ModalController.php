<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Description;
use App\Link;
use App\Parking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModalController extends Controller
{


    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN ÉLEMENT
    function descriptionModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_description = $request->input('description_id');
        $description = isset($id_description) ? Description::where('id', $id_description)->first() : new Description();

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/descriptions' : '/descriptions/' . $id_description;

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'description' => $description->description,
                'id' => $id_description,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute
            ]
        ];

        return view('modal.description', $data);
    }

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UNE FALAISE
    function cragModal(Request $request){

        $id = $request->input('id');
        if(isset($id)){
            $crag = Crag::where('id', $id)->with('orientation')->with('season')->first();
            $callback = 'refresh';
        }else{
            $crag = new Crag();
            $crag->lat = $request->input('lat');
            $crag->lng = $request->input('lng');
            $crag->code_country = 'NC';
            $crag->country = 'Inconnu';
            $callback = 'goToNewCrag';
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/crags' : '/crags/' . $id;

        $data = [
            'dataModal' => [
                'crag' => $crag,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.crag', $data);
    }

    //AFFICHE LA POPUP POUR SUPPRIMER UN ÉLÉMENT
    function deleteModal(Request $request){
        $data = [
            'dataModal' => [
                'id' => $request->input('id'),
                'route' => $request->input('route')
            ]
        ];
        return view('modal.delete', $data);
    }


    //AFFICHE LA POPUP DE SIGALEMENT D'UN PROBLÈME
    function problemModal(Request $request){

        $userEmail = '';
        if(Auth::check()){
            $user = User::where('id', Auth::id())->first();
            $userEmail = $user->email;
        }

        $data = [
            'dataModal' => [
                'id' => $request->input('id'),
                'model' => $request->input('model'),
                'email' => $userEmail
            ]
        ];
        return view('modal.problem', $data);
    }


    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function linkModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_link = $request->input('link_id');
        $link = isset($id_link) ? Link::where('id', $id_link)->first() : new Link();

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/links' : '/links/' . $id_link;

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'label' => $link->label,
                'link' => $link->link,
                'description' => $link->description,
                'id' => $id_link,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute
            ]
        ];

        return view('modal.link', $data);
    }

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN PARKING
    function parkingModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_parking = $request->input('parking_id');
        if (isset($id_parking)) {
            $parking = Parking::where('id', $id_parking)->first();
        } else {
            $parking = new Parking();
            $parking->lat = $request->input('lat');
            $parking->lng = $request->input('lng');
        }

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/parkings' : '/parkings/' . $id_parking;

        $data = [
            'dataModal' => [
                'crag_id' => $request->input('crag_id'),
                'lat' => $parking->lat,
                'lng' => $parking->lng,
                'description' => $parking->description,
                'id' => $id_parking,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute
            ]
        ];

        return view('modal.parking', $data);
    }
}