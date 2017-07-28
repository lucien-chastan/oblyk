<div class="card-panel">
    <h2 class="loved-king-font">Ils cherchent des grimpeurs ici :</h2>
    <div class="blue-border-zone">
        @php($ImThere = false)
        @foreach($partners as $partner)

            @if($partner->id == Auth::id())
                @php($ImThere = true)
            @endif

            <div class="blue-border-div">
                <p class="no-margin">
                    <a href="{{ route('userPage',['user_id'=>$partner->id,'user_label'=>str_slug($partner->name)]) }}"><i class="material-icons left">person_pin_circle</i> {{ $partner->name }}</a>
                    <span class="grey-text">
                        @if($partner->sex == 0) Indéfini, @endif
                        @if($partner->sex == 1) Femme, @endif
                        @if($partner->sex == 2) Homme, @endif
                        @if($partner->birth == 0) ? ans @endif
                        @if($partner->birth != 0) {{ date('Y') - $partner->birth }} ans @endif
                    </span>
                </p>
            </div>
        @endforeach
    </div>

    @if(count($partners) == 0)
        <p class="grey-text text-center">Pour l'instant, aucun grimpeur n'a indiqué qu'il escaladait ici</p>
    @endif

    @if(Auth::check() && $ImThere == false)
        @if($user->partnerSettings->partner == 0)
            <p class="text-center">
                <a href="{{ route('userPage',['user_id'=>$user->id,'user_label'=>str_slug($user->name)]) }}#partenaire-parametres" class="btn-flat blue-text"><i class="material-icons left">person_pin</i> Faire partie de la recherche</a>
            </p>
        @else
            <p class="text-center">
                <a {!! $Helpers::modal(route('partnerModal'), ["place_id"=>"", "lat"=>$crag->lat, "lng"=>$crag->lng, "label"=>$crag->label, "rayon"=>2, "title"=>"Ajouter un lieu", "method"=>"POST", "callback"=>"refresh" ]) !!} class="btn-flat blue-text btnModal"><i class="material-icons left">person_pin</i> Moi je grimpe ici !</a>
            </p>
        @endif
    @endif
</div>