<div class="navbar-fixed oblyk-navbar">

    {{--DROPDOWN DE LA CONNEXION--}}
    <ul id="dropdown_connexion" class="dropdown-content dropD-180">
        @include('includes.nav-user')
    </ul>

    {{--DROPDOWN DES LANGUES--}}
    <ul id="dropdown_language" class="dropdown-content dropD-auto">
        @include('includes.nav-localization')
    </ul>

    {{--MENU--}}
    <nav>
        <div class="nav-wrapper nav-white" id="nav_barre">

            {{--logo de oblyk--}}
            <a href="{{ route('gymPage', ['gym_id' => $gym->id, 'gym_label' => str_slug($gym->label)]) }}" class="brand-logo">
                <img src="/storage/gyms/50/logo-141.png" class="logo-de-oblyk">
                {{ $gym->label }}{{ env('APP_ENV') == 'beta' ? '- Beta' :'' }}
            </a>

            {{--icone de menu quand on est sur smartphone--}}
            <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i> <span>Menu</span></a>

            {{--menu type desktop--}}
            <ul id="nav-mobile" class="right hide-on-med-and-down">
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

            {{--MENU POUR LES SMARTPHONE--}}
            <div class="side-nav" id="side-nav">
                {{-- contenu --}}
            </div>
        </div>
    </nav>
</div>