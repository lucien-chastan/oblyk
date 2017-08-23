@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_about'),
    'meta_description'=>trans('meta/project.description_about'),
    'meta_img'=>'/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">À propos d'oblyk</h1>

                <p>
                    Oblyk est une platforme communautaire dédiée à l'escalade, elle a pour but de créer une grande base de donnée des falaises et voies de France et du monde, aider les grimpeurs à trouver des partenaires, suivre sa progression en escalade en tenant un carnet de croix, et plus généralement Oblyk est un réseau social de la grimpe<br>
                    Oblyk est développé par <a href="http://www.lucien-chastan.fr/">Lucien CHASTAN</a>, le code source est ouvert au contribution via la platform <a href="https://github.com/lucien-chastan/oblyk">GitHub</a>.
                </p>

            </div>
        </div>
    </div>

@endsection
