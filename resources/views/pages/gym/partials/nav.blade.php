<div class="row">
    <div class="col s12">
        <ul class="tabs tabs-fixed-width gym-menu">
            <li class="tab col s2"><a class="router-link active" href="#index"><i class="material-icons">info</i><span> @lang('pages/gyms/global.tabInformation')</span></a></li>
            <li class="tab col s2"><a data-route="{{ route('vueFilActuGym',[$gym->id]) }}" data-callback="getGymPosts" class="router-link" href="#fil-actu"><i class="material-icons">shuffle</i><span>@lang('pages/gyms/global.tabNewsFeed')</span></a><span class="count-tab-ettiquette">{{$gym->posts_count}}</span></li>
            @if($gym->rooms_count == 1)
                <li class="tab col s2"><a class="router-link" href="{{ route('gymSchemePage', ['gym_id' => $gym->id, 'room_id' => $gym->rooms[0]->id, 'gym_label'=> str_slug($gym->label)]) }}"><i class="material-icons">view_quilt</i><span>Topo</span></a></li>
            @elseif($gym->rooms_count > 1)
                <li class="tab col s2"><a href="#"><i class="material-icons">view_quilt</i><span>Topos</span></a></li>
            @endif
            <li class="tab col s2"><a data-route="{{ route('vueMapGym',[$gym->id]) }}" data-callback="initGymMap" class="router-link" href="#map"><i class="material-icons">map</i><span>@lang('pages/gyms/global.tabMap')</span></a></li>
            @if($is_administrator)
                <li class="tab col s2"><a class="router-link" href="{{ route('gym_admin_home', ['gym_id' => $gym->id, 'gym_label'=> str_slug($gym->label)]) }}"><i class="material-icons">settings</i><span>Administrer</span></a></li>
            @endif
        </ul>
    </div>
</div>