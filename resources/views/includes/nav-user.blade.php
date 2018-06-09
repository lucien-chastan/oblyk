@if (Auth::guest())
    <li><a href="{{ route('login') }}"><i class="material-icons left">person</i>@lang('interface/nav.connect')</a></li>
    <li><a href="{{ route('register') }}"><i class="material-icons left">person_add</i>@lang('interface/nav.joinUs')</a></li>
@else
    <li><a @if(isset($user)) data-route="{{route('vueDashboardUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}"><i class="material-icons left">person</i>@lang('interface/nav.myProfile')</a></li>
    <li><a @if(isset($user)) data-route="{{route('vueFilActuUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#fil-actu"><i class="material-icons left">shuffle</i>@lang('interface/nav.newsFeed') <span class="red-text badge-dropdown-navbar" id="badge-nb-new-posts"></span></a></li>
    <li><a @if(isset($user)) data-route="{{route('vueCroixUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#croix"><i class="material-icons left">playlist_add_check</i>@lang('interface/nav.myCross')</a></li>
    <li><a @if(isset($user)) data-route="{{route('vueMessagesUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#messages"><i class="material-icons left">email</i>@lang('interface/nav.messenger') <span class="red-text badge-dropdown-navbar" id="badge-nb-new-message"></span></a></li>
    <li><a @if(isset($user)) data-route="{{route('vueNotificationsUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#notifications"><i class="material-icons left">notifications</i>@lang('interface/nav.notifications') <span class="red-text badge-dropdown-navbar" id="badge-nb-new-notification"></span></a></li>
    <li><a @if(isset($user)) data-route="{{route('vueEditSettingsUser',['user_id'=>$user->id])}}" class="router-profile-link" @endif href="{{route('userPage',['user_id'=>Auth::id(),'user_label'=>str_slug(Auth::user()->name)])}}#parametres"><i class="material-icons left">settings</i>@lang('interface/nav.settings')</a></li>
    <li class="divider"></li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons left">power_settings_new</i>@lang('interface/nav.logOut')</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
@endif