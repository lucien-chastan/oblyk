<?php

namespace App\Http\Controllers\CRUD;

use App\Cross;
use App\CrossSection;
use App\CrossUser;
use App\Description;
use App\Follow;
use App\Route;
use App\TickList;
use App\User;
use Carbon\Carbon;
use DebugBar;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CrossController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function crossModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_cross = $request->input('cross_id');
        $route_id = $request->input('route_id');
        $line = Route::where('id', $route_id)->with('routeSections')->first();
        $crossPitchs = [];
        $crossNote = 0;
        $crossDescription = '';
        $release_at = Carbon::now()->format('Y-m-d');

        //Nouveau ou Modifié
        if (isset($id_cross)) {
            $cross = Cross::where('id', $id_cross)->with('crossSections')->first();
            $release_at = $cross->release_at->format('Y-m-d');
            foreach ($cross->crossSections as $section) $crossPitchs[] = $section->route_section_id;

            //on va chercher une éventuelle description posté sur cette croix
            $description = Description::where('cross_id', $cross->id)->first();
            if(isset($description)){
                $crossNote = $description->note;
                $crossDescription = $description->description;
            }

        } else {
            $cross = new Cross();
            foreach ($line->routeSections as $section) $crossPitchs[] = $section->id;
        }

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvegarde
        $outputRoute = ($request->input('method') == 'POST')? '/crosses' : '/crosses/' . $id_cross;

        //on montre ou pas le champs pour le mode de grimpe
        $showMode = $line->climb_id == 3 || $line->climb_id == 4 || $line->climb_id == 5 || $line->climb_id == 6 ? '' : 'display:none';
        $showPitchs = count($line->routeSections) > 1 ? '' : 'display:none';

        $data = [
            'dataModal' => [
                'route_id' => $route_id,
                'status_id' => $cross->status_id,
                'mode_id' => $cross->mode_id,
                'hardness_id' => $cross->hardness_id,
                'environment' => $cross->environment,
                'release_at' => $release_at,
                'id' => $id_cross,
                'line' => $line,
                'showMode' => $showMode,
                'showPitchs' => $showPitchs,
                'crossPitchs' => $crossPitchs,
                'crossNote' => $crossNote,
                'crossDescription' => $crossDescription,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.cross', $data);
    }


    function crossUserModal(Request $request){

        //va chercher la liste des amis confirmés
        $friends = User::whereIn('id', Follow::friends(Auth::id()))->get();

        //construction de la définition (vide ou avec des infos)
        $id_cross = $request->input('cross_id');
        $cross = Cross::where('id', $id_cross)->with('crossUsers')->first();

        //liste des users déjà lié à cette croix
        $crossUsers = [];
        foreach ($cross->crossUsers as $user) $crossUsers[] = $user->id;

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = '/cross/users';

        DebugBar::addMessage(json_decode(json_encode(Follow::friends(Auth::id()))),'perso');
        DebugBar::addMessage(Auth::id(),'id');

        $data = [
            'dataModal' => [
                'crossUsers' => $crossUsers,
                'friends' => $friends,
                'id' => $id_cross,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.crossUser', $data);
    }


    function crossUsers (Request $request){

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
            'release_at' => 'required|date_format:Y-m-d',
        ]);

        //Enregistrement de la croix
        $cross = new Cross();
        $cross->route_id = $request->input('route_id');
        $cross->status_id = $request->input('status_id');
        $cross->mode_id = $request->input('mode_id');
        $cross->hardness_id = $request->input('hardness_id');
        $cross->environment = $request->input('environment');
        $cross->release_at = $request->input('release_at');
        $cross->user_id = Auth::id();
        $cross->save();


        //S'il y a une description
        if($request->input('note') != 1 || $request->input('description') != ''){
            $description = new Description();
            $description->descriptive_id = $cross->route_id;
            $description->descriptive_type = 'App\Route';
            $description->description = $request->input('description');
            $description->user_id = Auth::id();
            $description->cross_id = $cross->id;
            $description->note = $request->input('note');
            $description->save();
        }

        //On enregistre les sections de la voie qui ont été faite
        $crossTab = explode(';', $request->input('crossPitchs'));
        foreach ($crossTab as $routeSectionId){
            $crossSection = new CrossSection();
            $crossSection->route_section_id = $routeSectionId;
            $crossSection->cross_id = $cross->id;
            $crossSection->save();
        }


        //Si cette ligne faisait partie de la ticklist de la personne on la supprime
        $ticks = TickList::where([['route_id', $cross->route_id],['user_id', Auth::id()]])->get();
        foreach ($ticks as $tick) $tick->delete();

        return response()->json(json_encode($cross));

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
            'release_at' => 'required|date_format:Y-m-d',
        ]);

        //Mise à jour des données
        $cross = Cross::where('id', $request->input('id'))->with('crossSections')->first();
        if($cross->user_id == Auth::id()){
            $cross->status_id = $request->input('status_id');
            $cross->release_at = $request->input('release_at');
            $cross->status_id = $request->input('status_id');
            $cross->mode_id = $request->input('mode_id');
            $cross->hardness_id = $request->input('hardness_id');
            $cross->save();

            //on va chercher une éventuelle description posté sur cette croix
            $description = Description::where('cross_id', $cross->id)->first();
            if(isset($description)){
                $description->note = $request->input('note');
                $description->description = $request->input('description');
                $description->save();
            }else{
                //S'il n'y a pas de description, mais qu'on reçoi des infos, alors on la créer
                if($request->input('note') != 1 || $request->input('description') != ''){
                    $description = new Description();
                    $description->descriptive_id = $cross->route_id;
                    $description->descriptive_type = 'App\Route';
                    $description->description = $request->input('description');
                    $description->user_id = Auth::id();
                    $description->cross_id = $cross->id;
                    $description->note = $request->input('note');
                    $description->save();
                }
            }

            //on va mettre à jour la liste des sections cochées
            $pitchs = explode(';', $request->input('crossPitchs'));

            //passe UNE : on supprime les anciens qui sont en trop
            $clearSections = [];
            foreach ($cross->crossSections as $crossSection) {
                if(!in_array($crossSection->route_section_id, $pitchs)) {
                    $crossSection->delete();
                }else{
                    $clearSections[] = $crossSection->route_section_id;
                }
            }

            //passe DEUX : on ajoute les nouvelles longueur
            foreach ($pitchs as $pitch){
                if(!in_array($pitch, $clearSections)) {
                    $crossSection = new CrossSection();
                    $crossSection->cross_id = $cross->id;
                    $crossSection->route_section_id = $pitch;
                    $crossSection->save();
                }
            }
        }

        return response()->json(json_encode($cross));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cross = Cross::where('id', $id)->first();
        $oldCross = $cross;
        if($cross->user_id == Auth::id()){

            //on supprime les sections liées
            $crossSections = CrossSection::where('cross_id', $cross->id)->get();
            foreach ($crossSections as $crossSection) $crossSection->delete();

            //on supprime les user lié à cette croix
            $crossUsers = CrossUser::where('cross_id', $cross->id)->get();
            foreach ($crossUsers as $crossUser) $crossUser->delete();

            //on supprime les user lié à cette croix
            $crossDescriptions = Description::where('cross_id', $cross->id)->get();
            foreach ($crossDescriptions as $crossDescription) $crossDescription->delete();

            //on supprime la croix
            $cross->delete();
        }

        return response()->json($oldCross);
    }

}
