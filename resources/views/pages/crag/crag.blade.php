@extends('layouts.app')

@section('css')
    <link href="/css/crag.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.crag-parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">

        <div class="row">
            <div class="col s12">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab col s2"><a class="active" href="#test1">Informations</a></li>
                    <li class="tab col s2"><a href="#test2">Fils d'actu</a></li>
                    <li class="tab col s2"><a href="#test3">Voies</a></li>
                    <li class="tab col s2"><a href="#test4">Médias</a></li>
                    <li class="tab col s2"><a href="#test5">Liens</a></li>
                    <li class="tab col s2"><a href="#test6">Topos</a></li>
                    <li class="tab col s2"><a href="#test7">Map</a></li>
                </ul>
            </div>
        </div>

        <div class="row info-crag">
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
    </div>

@endsection

@section('script')
    <script></script>
@endsection