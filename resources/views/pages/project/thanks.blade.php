@extends('layouts.app', [
    'meta_title'=> trans('meta/project.meta/project.title_thanks'),
    'meta_description'=>trans('meta/project.meta/project.description_thanks'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/thanks.title')</h1>

                <div class="row">

                    <div class="col s12 m6">
                        <img src="/img/thanks.svg" alt="" class="infographie-contact">
                    </div>

                    <div class="col s12 m6">
                        <p>@lang('pages/projects/thanks.para_1')</p>
                        <p class="text-center grey-text">@lang('pages/projects/thanks.para_2')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
