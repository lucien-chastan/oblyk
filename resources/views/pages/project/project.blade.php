@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_project'),
    'meta_description'=>trans('meta/project.description_project'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/project.title_1')</h1>

                <p>@lang('pages/projects/project.para_1_1')</p>
                <p>@lang('pages/projects/project.para_1_2')</p>
                <p>@lang('pages/projects/project.para_1_3')</p>

                <ul class="oblyk-ul">
                    <li>@lang('pages/projects/project.ul1_li1')</li>
                    <li>@lang('pages/projects/project.ul1_li2')</li>
                    <li>@lang('pages/projects/project.ul1_li3')</li>
                </ul>

                <p class="center">
                    <img class="responsive-img" src="/img/amis-grimpeurs-convivialite.jpg" alt="Des bloqueurs qui marchent avec leur crash pad">
                </p>

                <p>@lang('pages/projects/project.para_1_4')</p>
                <p>@lang('pages/projects/project.para_1_5')</p>
                <p>@lang('pages/projects/project.para_1_6')</p>

                <p class="center">
                    <img class="responsive-img" src="/img/topos-escalade.jpg" alt="Des topos entassés">
                </p>

                <h3 class="loved-king-font center">@lang('pages/projects/project.title_2')</h3>

                <p>@lang('pages/projects/project.para_2_1')</p>
                <p>@lang('pages/projects/project.para_2_2')</p>
                <p>@lang('pages/projects/project.para_2_3')</p>
                <p>@lang('pages/projects/project.para_2_4')</p>

                <h3 class="loved-king-font center">@lang('pages/projects/project.title_3')</h3>

                <p>@lang('pages/projects/project.para_3_1')</p>
                <p>@lang('pages/projects/project.para_3_2')</p>
                <p>@lang('pages/projects/project.para_3_3')</p>

                <p class="center">
                    <img class="responsive-img" src="/img/groupe-convivialite-escalade.jpg" alt="Des grimpeurs qui jouent au Tarot">
                </p>

                <h3 class="loved-king-font center">@lang('pages/projects/project.title_4')</h3>

                <p>@lang('pages/projects/project.para_4_1')</p>
                <p>@lang('pages/projects/project.para_4_2')</p>
                <p>@lang('pages/projects/project.para_4_3')</p>
                <p>@lang('pages/projects/project.para_4_4')</p>

            </div>
        </div>
    </div>

@endsection
