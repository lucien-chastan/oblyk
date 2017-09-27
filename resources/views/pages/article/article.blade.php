@extends('layouts.app', [
    'meta_title'=> $article->label,
    'meta_description'=> $article->description,
    'meta_img'=>'https://oblyk.org' . $bandeau,
    ])

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
                    @lang('pages/articles/article.written_by',['name'=>$article->author, 'date'=>$article->created_at->format('d M Y')])<br>
                    @lang('pages/articles/article.views',['nb'=>$article->views])
                </div>
            </div>


            {{--LES COMMMENTAIRES--}}
            <div class="col s12">
                <h5 class="loved-king-font">@lang('pages/articles/article.titleComments')</h5>
                <div class="blue-border-zone">
                    @foreach ($article->descriptions as $description)
                        <div class="blue-border-div">
                            <div class="markdownZone">{{ $description->description }}</div>
                            <p class="info-user grey-text">

                                @lang('pages/articles/article.byDate',['auteur'=>$description->user->name, 'date'=>$description->created_at->format('d M Y')])

                                @if(Auth::check())
                                    <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                    @if($description->user_id == Auth::id())
                                        <i {!! $Helpers::tooltip(trans('pages/articles/article.editCommentTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$article->id, "descriptive_type"=>"Crag", "description_id"=>$description->id, "title"=>"Modifier mon commentaire", "method" => "PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                        <i {!! $Helpers::tooltip(trans('pages/articles/article.deleteCommentTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                    @endif
                                @endif
                            </p>
                        </div>
                    @endforeach

                    @if(count($article->descriptions) == 0)
                        <p class="grey-text text-center">@lang('pages/articles/article.noComment')</p>
                    @endif


                    {{--BOUTON POUR AJOUTER UN COMMENTAIRE--}}
                    @if(Auth::check())
                        <div class="text-right">
                            <a {!! $Helpers::tooltip(trans('pages/articles/article.addCommentTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$article->id, "descriptive_type"=>"Article", "description_id"=>"", "title"=> trans('pages/articles/article.addCommentTitle'), "method"=>"POST"]) !!} id="description-btn-modal"  class="btn-floating btn waves-effect waves-light tooltipped btnModal"><i class="material-icons">mode_edit</i></a>
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