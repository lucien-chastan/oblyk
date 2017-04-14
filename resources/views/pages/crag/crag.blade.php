@extends('layouts.app')

@section('css')
    <link href="/css/crag.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.crag-parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--Menu des falaises--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs tabs-fixed-width crag-menu">
                    <li class="tab col s2"><a class="active" href="#test1"><i class="material-icons">info</i><span>Informations</span></a></li>
                    <li class="tab col s2"><a href="#test2"><i class="material-icons">shuffle</i><span>Fils d'actu</span></a></li>
                    <li class="tab col s2"><a href="#test3"><i class="material-icons">format_list_bulleted</i><span>Voies</span></a></li>
                    <li class="tab col s2"><a href="#test4"><i class="material-icons">collections</i><span>Médias</span></a></li>
                    <li class="tab col s2"><a href="#test5"><i class="material-icons">link</i><span>Liens</span></a></li>
                    <li class="tab col s2"><a href="#test6"><i class="material-icons">local_library</i><span>Topos</span></a></li>
                    <li class="tab col s2"><a href="#test7"><i class="material-icons">map</i><span>Map</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    {{--contenu de la page--}}
    <div class="container info-crag">
        <div class="row">

            <div class="col s12 m7">
                <div class="card-panel">

                    <h2 class="loved-king-font">Informations sur {{ $crag->label }}</h2>
                    <p>{{$crag['label']}} est un site d'escalade de {{ $crag->rocks->label }}, on y trouve x lignes de {{$crag->type_voie }}</p>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="card-panel">
                    <div class="row">
                        <div class="col s5">
                            <svg version="1.1" viewBox="0 0 100.61393 100.61393" height="28.395487mm" width="28.395487mm">
                                <g transform="translate(-299.43062,-288.93568)">
                                    <path style="fill:@if($crag->orientations->north){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-rule:evenodd;stroke:none" d="m 349.73758,288.93568 -11.20135,39.10561 11.20135,11.20135 0,-42.84708 9.54034,33.30673 1.66102,-1.661 z"/>
                                    <path style="fill:@if($crag->orientations->west){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 338.53623,328.04129 -39.10561,11.20135 39.10561,11.20136 11.20135,-11.20136 -42.84704,0 33.30671,-9.54033 z"/>
                                    <path style="fill:@if($crag->orientations->east){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-rule:evenodd;stroke:none" d="m 400.04455,339.24264 -39.10561,-11.20135 -11.20136,11.20135 42.84709,0 -33.30672,9.54034 1.66099,1.66104 z"/>
                                    <path style="fill:@if($crag->orientations->south){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-rule:evenodd;stroke:none" d="m 349.73758,389.54961 11.20136,-39.10561 -11.20136,-11.20136 0,42.84708 -9.54033,-33.30671 -1.66102,1.66099 z"/>
                                    <path style="fill:@if($crag->orientations->south_west){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 330.74892,348.21342 -10.44405,20.46194 20.46195,-10.44405 -2.23059,-7.78731 z"/>
                                    <path style="fill:@if($crag->orientations->north_west){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 340.76682,320.25398 -20.46195,-10.44405 10.44405,20.46195 7.78731,-2.23059 z"/>
                                    <path style="fill:@if($crag->orientations->north_east){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 368.72625,330.27188 10.44405,-20.46195 -20.46194,10.44406 2.23058,7.7873 z"/>
                                    <path style="fill:@if($crag->orientations->south_east){{'rgb(33,150,243)'}}@else{{'rgb(77,77,77)'}}@endif;fill-opacity:1;fill-rule:evenodd;stroke:none" d="m 358.70836,358.23133 20.46194,10.44403 -10.44405,-20.46194 -7.78731,2.23058 z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="col s7 petites-infos-crag">
                            <ul>
                                <li><i class="material-icons">pin_drop</i> <a href="#!">{{$crag->lat}}, {{$crag->lng}}</a></li>
                                <li><i class="material-icons">pin_drop</i> saison</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <h2 class="loved-king-font">Déscription par ce qui y grimpe</h2>
                    <p>
                        bla bla
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m7">
                <div class="card-panel">
                    <h2 class="loved-king-font">Topos papier</h2>
                    <p>
                        liste des topos
                    </p>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="card-panel">
                    <h2 class="loved-king-font">Topos web</h2>
                    <p>
                        liste des webs
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <h2 class="loved-king-font">Photo</h2>
                    <p>
                        liste des photos
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m4">
                <div class="card-panel">
                    <h2 class="loved-king-font">Type de lignes</h2>
                    <p>
                        graphe
                    </p>
                </div>
            </div>
            <div class="col s12 m8">
                <div class="card-panel">
                    <h2 class="loved-king-font">Cotations</h2>
                    <p>
                        graphe
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script></script>
@endsection