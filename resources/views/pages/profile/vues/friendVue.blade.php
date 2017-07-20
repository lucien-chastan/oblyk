@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">

        @foreach($friends as $friend)

            <div class="col s6 m3 l2 text-center friend-box">
                <div class="">
                    <img height="80" class="circle z-depth-2" src="{{$friend->followIcon}}">
                </div>
                <div>
                    <p class="truncate">
                        <a href="{{$friend->followUrl}}" class="text-bold">{{$friend->followName}}</a><br>
                        <span class="grey-text">
                            {{$friend->followInformation}}
                            @if(Auth::id() == $user->id)
                                <i {!! $Helpers::tooltip('Supprimer cette amis') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/follows/" . $friend->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                            @endif
                        </span>
                    </p>
                </div>
            </div>

        @endforeach

        @if(count($friends) == 0)
            @if(Auth::id() == $user->id)
                <p class="text-bold text-center grey-text">
                    Tu n'as pas encore d'amis ...<br>
                    Pour demander quelqu'un en amis, va sur la page de son profil et clique sur
                </p>
                <p class="text-bold text-center grey-text">
                    <i class="material-icons ic-exemple-ajouter-topo">star_border</i> Demander en amis
                </p>
            @else
                <p class="text-bold text-center grey-text">
                    {{$user->name}} n'as pas encore d'amis
                </p>
            @endif

        @endif
    </div>
</div>