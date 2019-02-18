@extends('layouts.app', [
    'meta_title'=> $newsletter['title'],
    'meta_description'=> $newsletter['abstract'],
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
    ])

@section('css')
    <link href="/css/project.css" rel="stylesheet">
@endsection


@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">

                <h1 class="loved-king-font text-center grey-text text-darken-3">#{{ str_replace('-','.',$newsletter->ref) }} {{ $newsletter->title }}</h1>

                <div class="markdownZone">
                    @markdown($newsletter->content)
                </div>
            </div>
        </div>
    </div>

@endsection
