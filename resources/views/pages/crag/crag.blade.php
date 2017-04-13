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

            <div class="col s12 m8">
                <div class="card-panel">

                    <h2 class="loved-king-font">Informations sur {{$crag['label']}}</h2>
                    <p>{{$crag['label']}} est un site d'escalade de {{$crag['rocks']['label']}}, on y trouve x lignes de {{$crag['type_voie']}}</p>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card-panel">
                    petite infos
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