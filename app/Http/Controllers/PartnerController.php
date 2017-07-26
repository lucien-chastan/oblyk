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
    function mapPage(){

        $user = User::where('id', Auth::id())
            ->with('partnerSettings')
            ->with(['places' => function ($query) {$query->where('active', 1);}])
            ->first();

        $data = [
            'meta_title' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
            'meta_description' => 'Carte des Grimpeurs, Trouver un partenaire d\'escalade',
            'user'=>$user
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

        if($user->sex == 0) $user->genre = 'Inféfini';
        if($user->sex == 1) $user->genre = 'Femme';
        if($user->sex == 2) $user->genre = 'Homme';

        $user->age = $user->birth != 0 ? date('Y') - $user->birth : '?';

        $user->image = file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg';
        $user->bandeau = file_exists(storage_path('app/public/users/1300/bandeau-' . $user->id . '.jpg')) ? '/storage/users/1300/bandeau-' . $user->id . '.jpg' : '';

        $user->partnerSettings->grade_min_val = Route::gradeToVal($user->partnerSettings->grade_min,'');
        $user->partnerSettings->grade_max_val = Route::gradeToVal($user->partnerSettings->grade_max,'');

        $data = [
            'user'=> $user
        ];

        return view('pages.partenaire.vues.userInformation', $data);
    }
}
