@extends('layouts.app', [
    'meta_title'=> trans('meta/error.title_404'),
    'meta_description'=>trans('meta/error.description_404'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
    ])

@section('css')

@endsection


@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/error/404.title')</h1>

                <div class="row text-center">
                    <img alt="un grimpeur perdu" class="responsive-img" src="/img/404.svg">
                </div>

                <p class="grey-text text-center">
                    @lang('pages/error/404.text', ['url'=>route('map')])
                </p>

            </div>
        </div>
    </div>

@endsection
