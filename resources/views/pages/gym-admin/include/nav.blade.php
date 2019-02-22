<div class="admin-gym-bandeau grey darken-1" style="background-image: url('/storage/gyms/200/bandeau-{{ $gym->id }}.jpg')">
    <div class="left-col">
        <img src="/storage/gyms/100/logo-{{ $gym->id }}.png" alt="logo de {{ $gym->label }} " class="circle img-nav-user z-depth-3">
    </div>
    <div class="right-col">
        <p class="truncate">{{ $gym->label }}</p>
        <a href="{{ route('indoorPresentation') }}">
            <span class="badge-level level-{{ $gym->level() }} no-warp"><i class="material-icons left">star</i>{{ $gym->level_label() }}</span>
        </a>
    </div>
</div>

<ul class="collapsible" data-collapsible="accordion">

    {{-- Dashboard --}}
    <li>
        <div data-route="{{ route('gym_admin_dashboard_view', ['gym_id' => $gym->id]) }}" id="item-dashboard-menu" class="collapsible-header truncate router-admin-gym-link">
            <i class="material-icons">dashboard</i>
            <span class="hidden-1000">Dashboard</span>
        </div>
    </li>

    {{-- Acutality --}}
    <li>
        <div data-route="{{ route('gym_admin_flux_view', ['gym_id' => $gym->id]) }}" id="item-flux-menu" class="collapsible-header truncate router-admin-gym-link">
            <i class="material-icons">shuffle</i>
            <span class="hidden-1000">Actualité</span>
        </div>
    </li>

    {{-- Guidebook --}}
    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">view_quilt</i>
            <span class="hidden-1000">
                Topo
            </span>
        </div>
        <div class="collapsible-body">
            {{--<div data-route="{{ route('gym_admin_scheme_how', ['gym_id' => $gym->id]) }}" id="item-scheme-how-menu" class="row truncate router-admin-gym-link">--}}
                {{--<i class="left material-icons">school</i>--}}
                {{--<span class="hidden-1000">--}}
                    {{--Comment ça marche ?--}}
                {{--</span>--}}
            {{--</div>--}}
            <div data-route="{{ route('gym_admin_grades_gym', ['gym_id' => $gym->id]) }}" id="item-grade-menu" class="row truncate router-admin-gym-link">
                <i class="left material-icons">line_weight</i>
                <span class="hidden-1000">
                    Systèmes de cotation
                </span>
            </div>
            <div data-route="{{ route('gym_admin_schemes_gym', ['gym_id' => $gym->id]) }}" id="item-scheme-scheme-menu" class="row truncate router-admin-gym-link">
                <i class="left material-icons">home</i>
                <span class="hidden-1000">
                    Les espaces
                </span>
            </div>
            <div data-route="{{route('gym_admin_routes_view', ['gym_id' => $gym->id])}}" id="item-scheme-routes-menu" class="row truncate router-admin-gym-link">
                <i class="left material-icons">timeline</i>
                <span class="hidden-1000">
                    Liste des voies
                </span>
            </div>
        </div>
    </li>

    {{-- Community --}}
    <li>
        <div data-route="{{route('gym_admin_community_view', ['gym_id' => $gym->id])}}" id="item-community-menu" class="collapsible-header truncate router-admin-gym-link">
            <i class="material-icons">group</i>
            <span class="hidden-1000">Communauté</span>
        </div>
    </li>

    {{-- Statistic --}}
    {{--<li>--}}
        {{--<div data-route="{{route('gym_admin_statistic_view', ['gym_id' => $gym->id])}}" id="item-statistique-menu" class="collapsible-header truncate router-admin-gym-link">--}}
            {{--<i class="material-icons">equalizer</i>--}}
            {{--<span class="hidden-1000">Statistiques</span>--}}
        {{--</div>--}}
    {{--</li>--}}

    <li>
        <div class="collapsible-header truncate">
            <i class="material-icons">settings</i>
            <span class="hidden-1000">
                Gestion
            </span>
        </div>
        <div class="collapsible-body">
            {{-- Team --}}
            <div data-route="{{route('gym_admin_team_view', ['gym_id' => $gym->id])}}" id="item-team-menu" class="collapsible-header truncate router-admin-gym-link">
                <i class="material-icons">people_outline</i>
                <span class="hidden-1000">Équipe</span>
            </div>

            {{-- Logo and banner --}}
            <div data-route="{{route('gym_admin_logo_bandeau_upload_view', ['gym_id' => $gym->id])}}" id="item-upload-menu" class="collapsible-header truncate router-admin-gym-link">
                <i class="material-icons">collections</i>
                <span class="hidden-1000">Logo &amp; Bandeau</span>
            </div>

            {{-- Global information --}}
            <div data-route="{{route('gym_admin_settings_view', ['gym_id' => $gym->id])}}" id="item-information-menu" class="collapsible-header truncate router-admin-gym-link">
                <i class="material-icons">tune</i>
                <span class="hidden-1000">Information</span>
            </div>
        </div>
    </li>
</ul>
