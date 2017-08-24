@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_supportUs'),
    'meta_description'=>trans('meta/project.description_supportUs'),
    'meta_img'=>'/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">Nous soutenir</h1>

                <p class="text-center grey-text">Coming soon</p>
            </div>
        </div>
    </div>

@endsection
