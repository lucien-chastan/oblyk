@extends('layouts.app')

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/article.css" rel="stylesheet">
    <link href="/css/article-markdown.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include(
        'includes.article-parallax',
         [
            'imgSrc' => $bandeau,
            'imgAlt' => 'Falaise de baume rousse'
         ]
    )

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">

                <div class="text-bold text-justify">
                    @markdown($article->description)
                </div>

                <div class="article-markdown">
                    @markdown($article->body)
                </div>

                <div class="text-right grey-text">
                    Rédigé par {{$article->author}} le {{$article->created_at->format('d M Y')}}<br>
                    lu {{$article->views}} fois
                </div>
            </div>


            {{--LES COMMMENTAIRES--}}
            <div class="col s12">
                <h5 class="loved-king-font">Commentaires</h5>
                <div class="blue-border-zone">
                    @foreach ($article->descriptions as $description)
                        <div class="blue-border-div">
                            <div class="markdownZone">{{ $description->description }}</div>
                            <p class="info-user grey-text">
                                par {{$description->user->name}} le {{$description->created_at->format('d M Y')}}

                                @if(Auth::check())
                                    <i {!! $Helpers::tooltip('Signaler un problème') !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                    @if($description->user_id == Auth::id())
                                        <i {!! $Helpers::tooltip('Modifier mon commentaire') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$article->id, "descriptive_type"=>"Crag", "description_id"=>$description->id, "title"=>"Modifier mon commentaire", "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                        <i {!! $Helpers::tooltip('Supprimer mon commentaire') !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                    @endif
                                @endif
                            </p>
                        </div>
                    @endforeach

                    @if(count($article->descriptions) == 0)
                        <p class="grey-text text-center">Il n'y a pas de commentaire sur cette article</p>
                    @endif


                    {{--BOUTON POUR AJOUTER UN COMMENTAIRE--}}
                    @if(Auth::check())
                        <div class="text-right">
                            <a {!! $Helpers::tooltip('Ajouter un commentaire') !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$article->id, "descriptive_type"=>"Article", "description_id"=>"", "title"=>"Ajouter un commentaire", "method"=>"POST"]) !!} id="description-btn-modal"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/article.js"></script>
@endsection