<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Cross;
use App\Follow;
use App\TickList;
use App\User;
use App\UserPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CragController extends Controller
{
    function cragPage($crag_id, $crag_title){

        $crag = Crag::where('id', $crag_id)
            ->with('rock')
            ->with('orientation')
            ->with('season')
            ->withCount('routes')
            ->withCount('links')
            ->withCount('photos')
            ->withCount('videos')
            ->withCount('topos')
            ->withCount('topoWebs')
            ->withCount('topoPdfs')
            ->withCount('posts')
            ->withCount('versions')
            ->with('photos')
            ->with('photos.user')
            ->with('topos.topo')
            ->with('massives.massive')
            ->with('topoWebs.user')
            ->with('topoPdfs.user')
            ->with('gapGrade')
            ->with('descriptions.user')
            ->with('exceptions.user')
            ->with(['articleCrags.article' => function($query) {
                $query->where('publish','1');
            }])
            ->first();

        // Si le label à changé alors on redirige
        if(Crag::webUrl($crag_id, $crag_title) != $crag->url()) {
            return $this->cragRedirectionPage($crag_id);
        }

        // Compte le nombre d'article on vide
        $nbArticle = 0;
        foreach ($crag->articleCrags as $articleCrag) {
            if ($articleCrag->article != null) {
                $nbArticle++;
            }
        }

        $partners = User::whereIn('id', UserPlace::getPartnersAroundCenter($crag->lat, $crag->lng))->get();

        $user = User::where('id',Auth::id())->with('partnerSettings')->first();

        $crag_id = $crag->id;
        $userCrosses = Cross::where('user_id', Auth::id())
            ->whereHas('route', function ($query) use ($crag_id) {$query->where('crag_id', $crag_id);})
            ->with('route')
            ->with('route.routeSections')
            ->with('crossStatus')
            ->get();

        $userTicklists = TickList::where('user_id', Auth::id())
            ->whereHas('route', function ($query) use ($crag_id) {$query->where('crag_id', $crag_id);})
            ->with('route')
            ->with('route.routeSections')
            ->get();

        //on va chercher si l'utilisateur follow ce site
        $userFollow = Follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', 'App\Crag'],
                ['followed_id', '=', $crag->id]
            ]
        )->first();
        $userFollow = (isset($userFollow)) ? 'true' : 'false';

        //on ajoute une vue à la falaise
        $crag->views++;
        $crag->save();

        //type de grimpe sur ce site
        $climbTypes = '<span class="crag-type-grimpe">';
        if($crag->type_voie == 1) $climbTypes .= '<span class="type-voie">' . trans('elements/climbs.climb_3') . '</span>';
        if($crag->type_grande_voie == 1) $climbTypes .= '<span class="type-grande-voie">' . trans('elements/climbs.climb_4') . '</span>';
        if($crag->type_bloc == 1) $climbTypes .= '<span class="type-bloc">' . trans('elements/climbs.climb_2') . '</span>';
        if($crag->type_deep_water == 1) $climbTypes .= '<span class="type-deep-water">' . trans('elements/climbs.climb_7') . '</span>';
        if($crag->type_via_ferrata == 1) $climbTypes .= '<span class="type-via-ferrata">' . trans('elements/climbs.climb_8') . '</span>';
        $climbTypes .= '</span>';

        $photos = $crag->allPhoto();

        $data = [
            'crag' => $crag,
            'climbTypes' => $climbTypes,
            'user' => $user,
            'userCrosses' => $userCrosses,
            'userTicklists' => $userTicklists,
            'meta_title' => $crag['label'],
            'meta_description' => 'description de ' . $crag['label'],
            'user_follow' => $userFollow,
            'partners' => $partners,
            'nbArticle' => $nbArticle,
            'cragPhotos' => $photos,
        ];

        return view('pages.crag.crag', $data);
    }

    public function cragRedirectionPage($crag_id) {
        $crag = Crag::find($crag_id);
        return redirect($crag->url(),301);
    }
}
