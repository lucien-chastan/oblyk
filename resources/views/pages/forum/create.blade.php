@extends('layouts.app')

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
                <h1 class="loved-king-font text-center grey-text text-darken-3">Créer un sujet</h1>

                <p>
                    Tu es sur le point de créer un nouveau sujet sur le forum d'escalade d'Oblyk. Avant d'aller plus loin, merci de vérifier que le sujet n'existe pas déjà (tu peux utiliser la recherche), Assure-toi d'avoir bien lu les quelques règles à respecter sur le forum. Les grimpeurs d'Oblyk auront sûrement la réponse à ta question ! ; )
                </p>

                <form class="submit-form" data-route="/topics" onsubmit="submitData(this, gotToNewTopics); return false">

                    {!! $Inputs::popupError([]) !!}

                    <div class="row">
                        {!! $Inputs::text(['name'=>'label', 'id'=>'label-new-sujet' , 'value'=>'', 'label'=>'Titre de ton sujet', 'type'=>'text']) !!}
                        {!! $Inputs::categories(['name'=>'category_id', 'value'=>$category_id, 'label'=>'Categories du sujet']) !!}
                        <div class="row">
                            {!! $Inputs::Submit(['label'=>'Créer', 'cancelable'=>false]) !!}
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
