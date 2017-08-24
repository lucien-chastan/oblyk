@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_contact'),
    'meta_description'=>trans('meta/project.description_contact'),
    'meta_img'=>'/img/meta_home.jpg',
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/contact.title')</h1>

                <div class="row">

                    <div class="col s12 m6">
                        <img src="/img/contact-infographie.svg" alt="un bloqueur poste une lettre" class="infographie-contact">
                    </div>

                    <div class="col s12 m6">
                        <p>@lang('pages/projects/contact.para')</p>

                        <p class="text-center">
                             <a href="mailto:ekip&#64;oblyk.org">ekip&#64;oblyk.org</a>
                        </p>

                        <p class="text-center grey-text">@lang('pages/projects/contact.conclusion')</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
