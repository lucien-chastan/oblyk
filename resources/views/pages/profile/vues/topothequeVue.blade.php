@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">

        @foreach($topos as $topo)

            <div class="col s12 m4 l3 text-center div-one-topo-in-topotheque">
                <div class="encombrement-couverture-topo">
                    <img class="couverture-topotheque z-depth-2" src="{{$topo->followIcon}}">
                </div>
                <div>
                    <p class="truncate">
                        <a href="{{$topo->followUrl}}" class="text-bold">{{$topo->followName}}</a><br>
                        <span class="grey-text">
                            {{$topo->followInformation}}
                            @if(Auth::id() == $user->id)
                                <i {!! $Helpers::tooltip('Supprimer ce topo de ma topothèque') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/follows/" . $topo->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                            @endif
                        </span>
                    </p>
                </div>
            </div>

        @endforeach

        @if(count($topos) == 0)
            @if(Auth::id() == $user->id)
                <p class="text-bold text-center grey-text">
                    Tu n'as pas encore de topo dans ta Topothèque ...<br>
                    Pour ajouter un topo à ta Topothèque, rend-toi sur la page d'un topo et clique sur :
                </p>
                <p class="text-bold text-center grey-text">
                    <i class="material-icons ic-exemple-ajouter-topo">photo_album</i> Ajouter à ma Topothèque
                </p>
            @else
                <p class="text-bold text-center grey-text">
                    {{$user->name}} n'as pas encore de topo dans sa Topothèque
                </p>
            @endif

        @endif
    </div>
</div>