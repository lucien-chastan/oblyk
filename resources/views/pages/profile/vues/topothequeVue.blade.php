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
                                <i {!! $Helpers::tooltip(trans('pages/profile/topotheque.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/follows/" . $topo->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                            @endif
                        </span>
                    </p>
                </div>
            </div>

        @endforeach

        @if(count($topos) == 0)
            @if(Auth::id() == $user->id)
                <p class="text-bold text-center grey-text">
                    @lang('pages/profile/topotheque.noGuidebookMe')
                </p>
                <p class="text-bold text-center grey-text">
                    <i class="material-icons ic-exemple-ajouter-topo">photo_album</i> @lang('pages/profile/topotheque.exampleAddGuidebookAction')
                </p>
            @else
                <p class="text-bold text-center grey-text">
                    @lang('pages/profile/topotheque.noGuidebookOther', ['name'=>$user->name])
                </p>
            @endif

        @endif
    </div>
</div>