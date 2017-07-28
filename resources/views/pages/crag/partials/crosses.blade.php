<div class="card-panel">
    <h2 class="loved-king-font">Ma ticklist, Mes croix ici</h2>
    @if(Auth::check())

        {{--MES CROIX--}}
        <div class="row">
            <div class="col s12 l6">
                <p class="text-underline text-bold">Mes croix</p>
                @foreach($userCrosses as $cross)
                    <p class="no-margin">
                        <span class="text-cursor button-open-route" onclick="loadRoute({{$cross->route->id}})">
                            <img src="/img/climb-{{$cross->route->climb_id}}.png" height="10">
                            <strong>
                                @if(count($cross->route->routeSections) == 1)
                                    <span class="color-grade-{{$cross->route->routeSections[0]->grade_val}}">{{$cross->route->routeSections[0]->grade}}{{$cross->route->routeSections[0]->sub_grade}}</span>
                                @else
                                    {{count($cross->route->routeSections)}}L.
                                @endif
                            </strong>
                            {{$cross->route->label}}, <span class="grey-text">{{$cross->crossStatus->label}}</span>
                        </span>
                    </p>
                @endforeach
                <p class="text-center"><a href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#croix">Voir mon carnet</a></p>
            </div>

            {{--TICK LIST--}}
            <div class="col s12 l6">
                <p class="text-underline text-bold">Ma ticklist</p>
                @foreach($userTicklists as $tick)
                    <p class="no-margin">
                        <span class="text-cursor button-open-route" onclick="loadRoute({{$tick->route->id}})">
                            <img src="/img/climb-{{$tick->route->climb_id}}.png" height="10">
                            <strong>
                                @if(count($tick->route->routeSections) == 1)
                                    <span class="color-grade-{{$tick->route->routeSections[0]->grade_val}}">{{$tick->route->routeSections[0]->grade}}{{$tick->route->routeSections[0]->sub_grade}}</span>
                                @else
                                    {{count($tick->route->routeSections)}}L.
                                @endif
                            </strong>
                            {{$tick->route->label}}
                        </span>
                    </p>
                @endforeach
                <p class="text-center"><a href="{{ route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)]) }}#tick-list">Voir ma ticklist</a></p>
            </div>
        </div>
    @else
        <p class="text-center grey-text">
            Créer toi un compte pour pouvoir tenir un carnet de croix sur ce site<br>
            <a href="{{ route('register') }}">Créer un compte</a>
        </p>
    @endif
</div>