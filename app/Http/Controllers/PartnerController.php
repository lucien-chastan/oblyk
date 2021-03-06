<?php

namespace App\Http\Controllers;

use App\Route;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{

    function howPage(){
        $data = [
            'meta_title' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
            'meta_description' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade'
        ];

        return view('pages.partenaire.partenaireHowToUser', $data);
    }


    function mapPage(){

        $user = User::where('id', Auth::id())
            ->with('partnerSettings')
            ->withCount(['places' => function ($query) {$query->where('active', 1);}])
            ->first();

        $places = UserPlace::whereIn('id', UserPlace::matchPlaces())->with('user')->get();

        $data = [
            'meta_title' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
            'meta_description' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
            'user'=>$user,
            'places'=>$places
        ];

        return view('pages.partenaire.partenaireMap', $data);
    }

    function getPartnerPoints(){

        $users = User::where('id','!=',Auth::id())
            ->whereHas('partnerSettings', function ($query) {$query->where('partner','=', 1);})
            ->with(['places' => function ($query) {$query->where('active', 1);}])
            ->get();

        foreach ($users as $key => $user) $users[$key]->photo = file_exists(storage_path('app/public/users/50/user-' . $user->id . '.jpg')) ? '/storage/users/50/user-' . $user->id . '.jpg' : '/img/icon-default-map.svg';

        $data = ['users'=>$users];

        return response()->json($data);
    }

    function getMyPlaces(){

        $user = User::where('id',Auth::id())
            ->with('partnerSettings')
            ->with(['places' => function ($query) {$query->where('active', 1);}])
            ->first();

        $data = ['user'=>$user];

        return response()->json($data);
    }

    //VA CHERCHE LES INFORMATIONS D'UN USER POUR LES AFFICHER DANS LE VOLET
    function getUserInformation(Request $request){
        $user = User::where('id',$request->input('user_id'))
            ->with('partnerSettings')
            ->with(['places'=>function($query) {$query->where('active', 1);}])
            ->first();

        $authUser = User::where('id', Auth::id())->first();

        $user->genre = ($user->sex != null) ? trans('elements/sex.sex_' . $user->sex) : trans('elements/sex.sex_0');

        $user->age = $user->birth != 0 ? trans_choice('elements/old.old',date('Y') - $user->birth) : trans_choice('elements/old.old', 0);

        $user->image = file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';
        $user->bandeau = file_exists(storage_path('app/public/users/1300/bandeau-' . $user->id . '.jpg')) ? '/storage/users/1300/bandeau-' . $user->id . '.jpg' : '';

        $user->partnerSettings->grade_min_val = Route::gradeToVal($user->partnerSettings->grade_min,'');
        $user->partnerSettings->grade_max_val = Route::gradeToVal($user->partnerSettings->grade_max,'');

        $data = [
            'user'=> $user,
            'authUser'=> $authUser,
        ];

        return view('pages.partenaire.vues.userInformation', $data);
    }
}
