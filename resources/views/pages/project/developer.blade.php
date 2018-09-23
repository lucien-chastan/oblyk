@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_developer'),
    'meta_description'=>trans('meta/project.description_developer'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/developer.title')</h1>

                <h3 class="loved-king-font">@lang('pages/projects/developer.titleContribute')</h3>

                <p>
                    @lang('pages/projects/developer.paragraphContribute')
                </p>

                <h3 class="loved-king-font">@lang('pages/projects/developer.titleAPI')</h3>

                <p>
                    @lang('pages/projects/developer.paragraphAPI')
                </p>

                <h3 class="loved-king-font">@lang('pages/projects/developer.titleIframe')</h3>
                <p>
                    @lang('pages/projects/developer.paragraphIframe')
                </p>

                <iframe src="https://oblyk.org/iframe/crag/18" width="100%" height="150px" frameborder="0"></iframe>

                <p class="text-underline">@lang('pages/projects/developer.codeExample')</p>
                <pre>{{ '<iframe src="https://oblyk.org/iframe/crag/{id}" width="100%" height="150px" frameborder="0"></iframe>' }}</pre>
            </div>
        </div>
    </div>

@endsection
