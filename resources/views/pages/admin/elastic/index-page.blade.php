@extends('layouts.admin', ['meta_title'=> 'Dashboard | Elastic'])

@section('content')

    <h3 class="loved-king-font text-center">Index les modèles dans elastic search</h3>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticWords()" class="waves-effect waves-light btn"><i class="material-icons left">text_format</i>Indexer les Words</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticCrags()" class="waves-effect waves-light btn"><i class="material-icons left">terrain</i>Indexer les Falaises</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticGyms()" class="waves-effect waves-light btn"><i class="material-icons left">account_balance</i>Indexer les Salles</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticTopics()" class="waves-effect waves-light btn"><i class="material-icons left">question_answer</i>Indexer les Topics</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticHelps()" class="waves-effect waves-light btn"><i class="material-icons left">question_answer</i>Indexer les Aides</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticMassives()" class="waves-effect waves-light btn"><i class="material-icons left">perm_media</i>Indexer les Massif</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticRoutes()" class="waves-effect waves-light btn"><i class="material-icons left">timeline</i>Indexer les routes</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticTopos()" class="waves-effect waves-light btn"><i class="material-icons left">local_library</i>Indexer les topos</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticTopoPdfs()" class="waves-effect waves-light btn"><i class="material-icons left">picture_as_pdf</i>Indexer les topos Pdf</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticTopoWebs()" class="waves-effect waves-light btn"><i class="material-icons left">link</i>Indexer les topos Webs</a>
        </div>
    </div>

    <div class="row">
        <div class="col s12 text-center">
            <a onclick="elasticUsers()" class="waves-effect waves-light btn"><i class="material-icons left">account_circle</i>Indexer les Grimpeurs</a>
        </div>
    </div>


@endsection