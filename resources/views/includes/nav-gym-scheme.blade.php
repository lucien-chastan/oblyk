<div class="navbar-fixed oblyk-navbar">

    {{-- Connexion dropdown --}}
    <ul id="dropdown_connexion" class="dropdown-content dropD-180">
        @include('includes.nav-user')
    </ul>

    {{-- Language dropdown --}}
    <ul id="dropdown_language" class="dropdown-content dropD-auto">
        @include('includes.nav-localization')
    </ul>

    @if($gym->rooms_count != 0 || (Auth::check() && $gym->userIsAdministrator(Auth::id())))
        <ul id="dropdown_rooms" class="dropdown-content dropD-auto">
            @foreach($rooms as $list_room)
                <li><a href="{{ $list_room->url() }}"><img alt="logo d'une salle" src="/img/icon-tab-gym.svg" class="left room-icon" height="20">{{ $list_room->label }}</a></li>
            @endforeach
            @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
                <li class="divider"></li>
                <li><a {!! $Helpers::tooltip('Ajouter un espace') !!} {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un topo', "method"=>"POST", "callback"=>"loadNewGymRoom"]) !!} id="scheme-btn-modal" class="tooltipped btnModal">Ajouter un espace<i class="material-icons left">add</i></a></li>
            @endif
        </ul>
    @endif

    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <ul id="dropdown_administrator" class="dropdown-content dropD-auto">
            <li><a {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["id"=>$room->id, "title"=>'Paramétrer la salle', "method"=>"PUT", "callback"=>"reloadPage"]) !!} class="btnModal">Paramétrer la salle<i class="material-icons left">edit</i></a></li>
            <li><a {!! $Helpers::modal(route('roomUploadSchemeModal', ['gym_id'=>$gym->id]), ["room_id"=>$room->id, "title"=>'Telecharger un plan', "method"=>"POST", "callback"=>"reloadPage"]) !!} class="btnModal">Changer le plan<i class="material-icons left">map</i></a></li>
            <li><a {!! $Helpers::modal(route('roomCustomScheme', ['gym_id'=>$gym->id, 'room_id'=>$room->id]), ["room_id"=>$room->id, "title"=>'Personnaliser le topo', "method"=>"PUT", "callback"=>"reloadPage"]) !!} class="btnModal">Personnaliser<i class="material-icons left">color_lens</i></a></li>
            <li><a href="{{ route('gym_admin_home', ['gym_id' => $gym->id, 'gym_label'=> str_slug($gym->label)]) }}">Dashboard<i class="material-icons left">dashboard</i></a></li>
            @if(!$room->isPublished())
                <li><a {!! $Helpers::modal(route('roomPublishModal', ['gym_id'=>$gym->id, 'room_id'=>$room->id]), ["room_id"=>$room->id, "title"=>'Publier le topo', "method"=>"PUT", "callback"=>"reloadPage"]) !!} class="btnModal">Rendre visible<i class="material-icons left">visibility</i></a></li>
            @endif
            <li class="divider"></li>
            @if($room->isPublished())
                <li><a {!! $Helpers::modal(route('roomPublishModal', ['gym_id'=>$gym->id, 'room_id'=>$room->id]), ["room_id"=>$room->id, "title"=>'Cacher le topo', "method"=>"PUT", "callback"=>"reloadPage"]) !!} class="btnModal">Cacher<i class="material-icons left red-text">visibility_off</i></a></li>
            @endif
            <li><a {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/rooms/" . $room->id, "callback" => "afterDeleteGotTo"]) !!} class="btnModal">Supprimer cette espace<i class="material-icons left red-text">delete</i></a></li>
        </ul>
    @endif

    {{-- Nav --}}
    <nav>
        <div class="nav-wrapper nav-white" id="nav_barre">

            {{-- Oblyk logo --}}
            <a href="{{ route('gymPage', ['gym_id' => $gym->id, 'gym_label' => str_slug($gym->label)]) }}" class="brand-logo">
                <img src="/storage/gyms/50/logo-{{ $gym->id }}.png" class="logo-de-oblyk">
                {{ $gym->label }}{{ env('APP_ENV') == 'beta' ? '- Beta' :'' }}
            </a>

            {{-- Response icon --}}
            <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i> <span>Menu</span></a>

            {{-- Desktop nav --}}
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
                    <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_administrator"><i class="material-icons left">tune</i> Paramètres <i class="material-icons right">arrow_drop_down</i></a></li>
                @endif
                @if($gym->rooms_count != 0)
                    <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_rooms"><i class="material-icons left">autorenew</i> {{ $room->label }} <i class="material-icons right">arrow_drop_down</i></a></li>
                @endif
                <li><a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_language">{{ LaravelLocalization::getCurrentLocale() }} <i class="material-icons right">arrow_drop_down</i></a></li>
                <li>
                    <a class="dropdown-button nav-dropdown" href="#!" data-activates="dropdown_connexion">
                        @if (Auth::guest())
                            @lang('interface/nav.connect')
                        @else
                            {{ Auth::user()->name }} <span id="global-badge-notification-message" class="global-badge-in-navbar red"></span>
                        @endif
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Responsive side nav --}}
        <ul class="side-nav collapsible" id="side-nav" data-collapsible="accordion">
            <li>
                <a class="gym-label" href="{{ route('gymPage', ['gym_id' => $gym->id, 'gym_label' => str_slug($gym->label)]) }}">
                    <img src="/storage/gyms/50/logo-{{ $gym->id }}.png" class="logo-de-oblyk">
                    {{ $gym->label }}{{ env('APP_ENV') == 'beta' ? '- Beta' :'' }}
                </a>
            </li>
            <li><div class="divider"></div></li>
            <li>@include('includes.nav-user-side-nav')</li>
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">autorenew</i>
                    {{ $room->label }}
                </div>
                <div class="collapsible-body">
                    <ul>
                        @foreach($rooms as $list_room)
                            <li><a href="{{ $list_room->url() }}"><img alt="logo d'une salle" src="/img/icon-tab-gym.svg" class="left room-icon room-icon-side-nav" height="20">{{ $list_room->label }}</a></li>
                        @endforeach
                        @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
                            <li class="divider"></li>
                            <li><a {!! $Helpers::tooltip('Ajouter un espace') !!} {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["gym_id"=>$gym->id, "title"=>'Créer un topo', "method"=>"POST", "callback"=>"loadNewGymRoom"]) !!} id="scheme-btn-modal" class="tooltipped btnModal">Ajouter un espace<i class="material-icons left">add</i></a></li>
                        @endif
                    </ul>
                </div>
            </li>
            @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons">tune</i>
                        Paramétres
                    </div>
                    <div class="collapsible-body">
                        <ul>
                            <li><a {!! $Helpers::modal(route('roomModal', ['gym_id'=>$gym->id]), ["id"=>$room->id, "title"=>'Paramétrer la salle', "method"=>"PUT", "callback"=>"reloadPage"]) !!} class="btnModal">Paramétrer la salle<i class="material-icons left">edit</i></a></li>
                            <li><a {!! $Helpers::modal(route('roomUploadSchemeModal', ['gym_id'=>$gym->id]), ["room_id"=>$room->id, "title"=>'Telecharger un plan', "method"=>"POST", "callback"=>"reloadPage"]) !!} class="btnModal">Changer le plan<i class="material-icons left">map</i></a></li>
                            <li><a {!! $Helpers::modal(route('roomCustomScheme', ['gym_id'=>$gym->id, 'room_id'=>$room->id]), ["room_id"=>$room->id, "title"=>'Personnaliser le topo', "method"=>"PUT", "callback"=>"reloadPage"]) !!} class="btnModal">Personnaliser<i class="material-icons left">color_lens</i></a></li>
                            <li><a href="{{ route('gym_admin_home', ['gym_id' => $gym->id, 'gym_label'=> str_slug($gym->label)]) }}">Dashboard<i class="material-icons left">dashboard</i></a></li>
                            <li class="divider"></li>
                            <li><a {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/rooms/" . $room->id, "callback" => "afterDeleteGotTo"]) !!} class="btnModal">Supprimer cette espace<i class="material-icons left red-text">delete</i></a></li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </nav>
</div>