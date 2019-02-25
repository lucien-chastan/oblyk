@inject('Helpers','App\Lib\HelpersTemplates')

@extends('layouts.map-gym',[
    'meta_title' => trans('meta/gym-scheme.title', ['gym_label' => $gym->label, 'room_label' => $room->label]),
    'meta_description' => trans('meta/gym-scheme.description', ['gym_label' => $gym->label, 'room_label' => $room->label, 'city' => $gym->city, 'postal_code' => $gym->postal_code]),
    'meta_img'=> $room->hasScheme() ? $room->scheme() : $gym->bandeau(),
    'gym' => $gym,
    'room' => $room,
    'rooms' => $rooms,
    'colors' => $colors
])

@section('css')
    <link rel="stylesheet" href="/framework/leaflet/leaflet.css">
    <link rel="stylesheet" href="/framework/leaflet/markercluster.css">
    <link rel="stylesheet" href="/framework/leaflet/Control.Geocoder.css">
    <link rel="stylesheet" href="/framework/leaflet/leaflet.draw.css">
    <link rel="stylesheet" href="/css/gym-scheme.css">
    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.min.css">
    @endif
@endsection

@section('content')
    <div class="side-nav-is-open" id="body-map">
        <div id="gym-scheme"
             data-room-id="{{ $room->id }}"
             data-gym-id="{{ $room->gym_id }}"
             data-gym-label="{{ $gym->label }}"
             data-gym-url="{{ route('gymPage', ['gym_label'=>str_slug($gym->label), 'gym_id'=>$gym->id]) }}"
             data-banner-color="{{ $colors['bannerColor'] }}"
             data-banner-bg-color="{{ $colors['bannerBgColor'] }}"
             data-scheme-bg-color="{{ $colors['bgSchemeColor'] }}"
             data-scheme-height="{{ $room->scheme_height }}"
             data-scheme-width="{{ $room->scheme_width }}"
        >
            @if(!$room->hasScheme() && (Auth::check() && $gym->userIsAdministrator(Auth::id())))
                <div class="text-center" id="btn-add-first-scheme">
                    <button {!! $Helpers::modal(route('roomUploadSchemeModal', ['gym_id'=>$gym->id]), ["room_id"=>$room->id, "title"=> trans('pages/gym-schemes/global.uploadAScheme'), "method"=>"POST", "callback"=>"reloadPage"]) !!}  class="btn-flat btnModal">
                        <i class="material-icons left blue-text">wallpaper</i>
                        @lang('pages/gym-schemes/global.uploadFirstSchemeImage')
                    </button>
                </div>
            @endif
        </div>

        {{-- Close side nav buton --}}
        <div class="open-close-btn" id="open-close-btn" onclick="closeGymSchemeSideNave()" style="color: {{ $colors['bannerColor'] }}; background-color: {{ $colors['bannerBgColor'] }}">
            <div class="waves-effect">
                <i class="material-icons">keyboard_arrow_left</i>
            </div>
        </div>

        {{-- Sector and route sidenav --}}
        <div id="side-map-gym-scheme" class="side-map-gym-scheme">

            <div class="sector-banner grey darken-1" style="background-image: url('/storage/gyms/1300/bandeau-{{ $gym->id }}.jpg')">
                <div class="bottom-information">
                    <nav>
                        <div class="nav-wrapper loved-king-font">
                            <div class="col s12">
                                <a class="breadcrumb" id="item-nav-1" onclick="getSectors();animationLoadSideNav('l')">@lang('pages/gym-schemes/global.breadcrumbSector')</a>
                                <a class="breadcrumb" id="item-nav-2">Second</a>
                                <a class="breadcrumb" id="item-nav-3">Third</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div id="animation-div">
                <div id="content-side-map-gym-scheme" class="content-side-map-gym-scheme">
                    Ajax
                </div>
                <div id="load-side-map-gym-scheme" class="load-side-map-gym-scheme">
                    <div class="preloader-wrapper active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div><div class="gap-patch">
                                <div class="circle"></div>
                            </div><div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
            <div class="fixed-action-btn hide" id="edit-btn-sector">
                <a title="annuler l'édition" class="btn-floating btn-small grey" id="btn-cancel-edition-scheme">
                    <i class="large material-icons">clear</i>
                </a>
                <a title="supprimer le tracé" class="btn-floating btn-small grey" id="btn-delete-edition-scheme">
                    <i class="large material-icons">delete</i>
                </a>
                <a title="sauvegarder le tracé" class="btn-floating btn-large red" id="btn-save-edition-scheme">
                    <i class="large material-icons">save</i>
                </a>
            </div>
        @endif

        <div class="crosses-vue">
            <a onclick="showCrosses(false)" class="btn-floating btn-small waves-effect waves-light btn-flat right close-crosses-bnt"><i class="material-icons grey-text text-darken-3">close</i></a>
            <div id="crosses-vue">
                {{-- load with ajax --}}
            </div>
        </div>
    </div>

    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <input type="hidden" value="{{ route('getLastCreatedRoomRoute', ['gym_id' => $gym->id]) }}" id="last-created-room">
        <input type="hidden" value="{{ route('getFirstOrderRoomRoute', ['gym_id' => $gym->id]) }}" id="first-order-room">
    @endif
@endsection

@section('script')
    <script src="/framework/leaflet/leaflet.js"></script>
    <script src="/js/gym-scheme.js"></script>
    <script>
        var GlobalGymId = {{ $gym->id }},
            GlobalRoomId = {{ $room->id }}
    </script>
    @if(Auth::check())
        <script src="/js/indoor-crosses-chart.js"></script>
        <script src="/framework/chartJs/Chart.min.js"></script>
        @if($gym->userIsAdministrator(Auth::id()))
            <script src="/framework/leaflet/Leaflet.Editable.js"></script>
            <script src="/js/gym-edit-scheme.js"></script>
            <script src="/js/gym-upload-scheme.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.min.js"></script>
        @endif
    @endif

    @if($room->hasScheme())
        <script>
            initSchemeGymMap();
        </script>
    @endif
    <script>

        initGetElement();

        // Change nav bar color
        var nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>
@endsection
