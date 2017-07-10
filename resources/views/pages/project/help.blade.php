@extends('layouts.app')

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/project.css" rel="stylesheet">
    <link href="/css/markdown.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">Aides</h1>

                @foreach($helpCategory as $key => $category)
                    <h2 class="loved-king-font titre-2-helps">{{$key}}</h2>

                    <div class="blue-border-zone">
                        @foreach($category as $help)
                            <div class="blue-border-div">
                                <h6 onclick="openHelp('help-section-{{$help->id}}')" class="text-bold titre-6-helps">{{$help->label}}</h6>
                                <div class="section-aide" id="help-section-{{$help->id}}">
                                    <div class="markdownZone">@markdown($help->contents)</div>
                                    <p class="info-user grey-text">
                                        @if(isset($help->updated_at))
                                            dernière mise à jour : {{$help->updated_at->format('d M Y')}}
                                        @else
                                            créé le {{$help->created_at->format('d M Y')}}
                                        @endif
                                        <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$help->id, "model"=>"Help"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/project.js"></script>
@endsection