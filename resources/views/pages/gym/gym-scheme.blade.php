@inject('Helpers','App\Lib\HelpersTemplates')

@extends('layouts.map-gym',[
    'meta_title'=> 'Plan de la salle de laennec',
    'meta_description'=>'Description du plan de la salle de lanenec',
    'meta_img'=>'https://oblyk.org/img/map_meta.jpg',
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
@endsection

@section('content')
    <div class="side-nav-is-open">
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
                    <button {!! $Helpers::modal(route('roomUploadSchemeModal', ['gym_id'=>$gym->id]), ["room_id"=>$room->id, "title"=>'Telecharger un plan', "method"=>"POST", "callback"=>"reloadPage"]) !!}  class="btn-flat btnModal">
                        <i class="material-icons left blue-text">wallpaper</i>
                        Uploader le plan de mon topo
                    </button>
                </div>
            @endif
        </div>

        {{--SECTOR AND ROUTE SIDENAV--}}
        <div id="side-map-gym-scheme" class="side-map-gym-scheme">
            <div class="sector-banner grey darken-1" style="background-image: url('/storage/gyms/1300/bandeau-{{ $gym->id }}.jpg')">
                <div class="bottom-information">
                    <nav>
                        <div class="nav-wrapper loved-king-font">
                            <div class="col s12">
                                <a class="breadcrumb" id="item-nav-1" onclick="getSectors();animationLoadSideNav('l')">Les secteurs</a>
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
                <a class="btn-floating btn-small grey" onclick="relaodSectors({{ $room->id }})">
                    <i class="large material-icons">clear</i>
                </a>
                <a class="btn-floating btn-large red" onclick="endEditSector()">
                    <i class="large material-icons">save</i>
                </a>
            </div>
        @endif
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
    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <script src="/framework/leaflet/Leaflet.Editable.js"></script>
        <script src="/js/gym-edit-scheme.js"></script>
        <script src="/js/gym-upload-scheme.js"></script>
    @endif
    @if($room->hasScheme())
        <script>
            initSchemeGymMap();
        </script>
    @endif
    <script>
        getSectors();

        //passage de la barre de navigation en noir
        var nav_barre = document.getElementById('nav_barre');
        nav_barre.setAttribute('class', nav_barre.className.replace('nav-white','nav-black'));
    </script>
@endsection
