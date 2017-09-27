@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_indexes'),
    'meta_description'=>trans('meta/tools.description_indexes'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/indexes.title')</h1>

                <div class="row">
                    <div class="col s12 m6 l3">
                        <div class="card text-center">
                            <div class="card-content">
                                <span class="card-title"><a href="{{ route('cragsIndex') }}">@lang('pages/tools/indexes.titleCrags')</a></span>
                                <img src="/img/icon-search-crag.svg" height="100">
                                <p class="grey-text">@choice('pages/tools/indexes.nbCrags', $crags)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card text-center">
                            <div class="card-content">
                                <span class="card-title"><a href="{{ route('gymsIndex') }}">@lang('pages/tools/indexes.titleGyms')</a></span>
                                <img src="/img/icon-search-gym.svg" height="100">
                                <p class="grey-text">@choice('pages/tools/indexes.nbGyms', $gyms)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card text-center">
                            <div class="card-content">
                                <span class="card-title"><a href="{{ route('usersIndex') }}">@lang('pages/tools/indexes.titleUsers')</a></span>
                                <img src="/img/icon-search-user.svg" height="100">
                                <p class="grey-text">@choice('pages/tools/indexes.nbUsers', $climbers)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card text-center">
                            <div class="card-content">
                                <span class="card-title"><a href="{{ route('guidebooksIndex') }}">@lang('pages/tools/indexes.titleGuidebooks')</a></span>
                                <img src="/img/icon-search-guidebook.svg" height="100">
                                <p class="grey-text">@choice('pages/tools/indexes.nbGuidebooks', $guideBooks)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card text-center">
                            <div class="card-content">
                                <span class="card-title"><a href="{{ route('groupsIndex') }}">@lang('pages/tools/indexes.titleGroup')</a></span>
                                <img src="/img/icon-search-massive.svg" height="100">
                                <p class="grey-text">@choice('pages/tools/indexes.nbGroups', $massive)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card text-center">
                            <div class="card-content">
                                <span class="card-title"><a href="{{ route('routesIndex') }}">@lang('pages/tools/indexes.titleRoutes')</a></span>
                                <img src="/img/icon-search-route.svg" height="100">
                                <p class="grey-text">@choice('pages/tools/indexes.nbRoutes', $routes)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
