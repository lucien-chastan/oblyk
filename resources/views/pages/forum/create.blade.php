@extends('layouts.app',[
    'meta_title'=> trans('meta/forum.title_create'),
    'meta_description'=>trans('meta/forum.description_create'),
    'meta_img'=>'/img/forum-escalade-oblyk.jpg',
    ])

@inject('Inputs','App\Lib\InputTemplates')


@section('css')
    <link href="/css/forum.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/forum-escalade-oblyk.jpg', 'imgAlt' => 'le forum escalade de oblyk'))


    {{--contenu de la page--}}
    <div class="container">

        @include('pages.forum.partials.nav',['active'=>'create_topics'])

        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/forums/create.title')</h1>

                <p>
                    @lang('pages/forums/create.intro')
                </p>

                <form class="submit-form" data-route="/topics" onsubmit="submitData(this, gotToNewTopics); return false">

                    {!! $Inputs::popupError([]) !!}

                    <div class="row">
                        {!! $Inputs::text(['name'=>'label', 'id'=>'label-new-sujet' , 'value'=>'', 'label'=>trans('pages/forums/create.labelTitle'), 'type'=>'text']) !!}
                        {!! $Inputs::categories(['name'=>'category_id', 'value'=>$category_id, 'label'=>trans('pages/forums/create.selectCategory')]) !!}
                        <div class="row">
                            {!! $Inputs::Submit(['label'=>trans('pages/forums/create.submit'), 'cancelable'=>false]) !!}
                        </div>
                    </div>

                    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}
                    {!! $Inputs::Hidden(['name'=>'id','value'=>'']) !!}
                </form>


            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/js/forum.js"></script>
    <script src="/js/post.js"></script>
    <script>
        $('select').material_select();
        document.getElementById('label-new-sujet').focus();
    </script>
@endsection
