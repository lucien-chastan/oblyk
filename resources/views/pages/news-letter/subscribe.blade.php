@extends('layouts.app', [
    'meta_title'=> trans('meta/news-letter.title_subscribe'),
    'meta_description'=> trans('meta/news-letter.description_subscribe'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/news-letter/subscribe.title')</h1>

                <div class="row">

                    <div class="col s12 m6">
                        <img src="/img/contact-infographie.svg" alt="un bloqueur poste une lettre" class="infographie-contact">
                    </div>

                    <div class="col s12 m6">
                        @lang('pages/news-letter/subscribe.para')<br>
                        @lang('pages/news-letter/subscribe.subscribe-with') : {{ $email }}

                        <p class="text-center">
                            <a href="{{ route('unsubscribe') }}?email={{  $email }}">@lang('pages/news-letter/subscribe.unsubscribe')</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
