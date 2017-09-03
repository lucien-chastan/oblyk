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
                                <i {!! $Helpers::tooltip(trans('pages/profile/friend.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/follows/" . $friend->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                            @endif
                        </span>
                    </p>
                </div>
            </div>

        @endforeach

        @if(count($friends) == 0)
            @if(Auth::id() == $user->id)
                <p class="text-bold text-center grey-text">
                    @lang('pages/profile/friend.paraNoFriend')
                </p>
                <p class="text-bold text-center grey-text">
                    <i class="material-icons ic-exemple-ajouter-topo">star_border</i> @lang('pages/profile/friend.exampleFollowFriend')
                </p>
            @else
                <p class="text-bold text-center grey-text">
                    @lang('pages/profile/friend.paraOtherNoFriend', ['name'=>$user->name])
                </p>
            @endif

        @endif
    </div>
</div>