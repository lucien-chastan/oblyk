@extends('layouts.app',[
    'meta_title'=> trans('meta/glossary.title'),
    'meta_description'=>trans('meta/glossary.description'),
    'meta_img'=>'https://oblyk.org/img/default-lexique-bandeau.jpg',
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/lexique.css" rel="stylesheet">
@endsection

@section('content')

{{--parallax--}}
@include('includes.parallax', array('imgSrc' => '/img/default-lexique-bandeau.jpg', 'imgAlt' => 'Falaise de baume rousse'))

{{--contenu de la page--}}
<div class="container">
    <div class="row">
        <div class="col s12">
            <ul class="tabs tabs-fixed-width">
                @foreach($alphas as $alpha)
                    <li class="tab col s3"><a href="#{{$alpha}}">{{$alpha}}</a></li>
                @endforeach
            </ul>
        </div>

        @foreach($alphas as $alpha)
            <div id="{{$alpha}}" class="col s12">

                <div class="blue-border-zone">

                    @php($nbWord = 0)

                    @foreach($words as $word)


                        @if( strtolower(substr($Helpers::withoutAccent($word->label),0,1)) == $alpha)

                            @php($nbWord++)

                            <div class="blue-border-div">
                                <p class="text-bold">{{$word->label}}</p>
                                <div class="markdownZone">{{$word->definition}}</div>
                                <p class="info-user grey-text">
                                    @lang('modals/word.postByDate', ['name'=>$word->user->name, 'url'=>route('userPage',['user_id'=>$word->user->id, 'user_label'=>str_slug($word->user->name)]), 'date'=>$word->created_at->format('d M Y')])

                                    @if(Auth::check())
                                        <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id"=>$word->id, "model"=>"Word"]) !!} class="material-icons tiny-btn right tooltipped btnModal">flag</i>
                                        @if($word->user_id == Auth::id())
                                            <i {!! $Helpers::tooltip(trans('modals/word.editTooltip')) !!} {!! $Helpers::modal(route('wordModal'), ["word_id"=>$word->id, "title"=>trans('modals/word.modalEditeTitle'), "method"=>"PUT"]) !!} class="material-icons tiny-btn right tooltipped btnModal">edit</i>
                                            <i {!! $Helpers::tooltip(trans('modals/word.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/words/" . $word->id ]) !!} class="material-icons tiny-btn right tooltipped btnModal">delete</i>
                                            @if($word->versions_count > 0)
                                                <i {!! $Helpers::tooltip(trans('modals/version.tooltip')) !!} {!! $Helpers::modal(route('versionModal'), ["id"=>$word->id, "model"=>"Word"]) !!} class="material-icons tiny-btn right tooltipped btnModal">history</i>
                                            @endif
                                        @endif
                                    @endif
                                </p>
                            </div>

                        @endif

                    @endforeach
                </div>

                @if($nbWord == 0)
                    <p class="text-center grey-text">@lang('pages/glossary/glossary.noWord', ['lettre'=>$alpha])</p>
                @endif

            </div>
        @endforeach
    </div>

</div>

@if(Auth::check())
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i {!! $Helpers::tooltip(trans('modals/word.addTooltip')) !!} {!! $Helpers::modal(route('wordModal'), ["word_id"=>'', "title"=>trans('modals/word.modalAddTitle'), "method"=>"POST"]) !!} class="tooltipped btnModal large material-icons">add</i>
        </a>
    </div>
@endif

@endsection

@section('script')
    <script>
        convertMarkdownZone();
    </script>
@endsection