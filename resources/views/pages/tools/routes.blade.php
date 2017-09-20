@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_routes'),
    'meta_description'=>trans('meta/tools.description_routes'),
    'meta_img'=>'/img/meta_home.jpg',
    ])

@section('css')
    <link href="/css/tools.css" rel="stylesheet">
@endsection


@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row">
            <div class="col s12">
                <p>
                    <a href="{{ route('indexes') }}"><i class="material-icons left">arrow_back</i>@lang('pages/tools/indexes.backToIndexes')</a>
                </p>
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/routes.title')</h1>
                <p class="grey-text text-center">@choice('pages/tools/routes.nbRoutes', $nb)</p>

                <table class="centered">
                    <thead>
                        <tr>
                            <th>
                                <a class="black-text" rel="nofollow" href="{{ route('routesIndex') }}?order=label&direction={{ ($order == 'label') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/routes.columnLabel')
                                    @if($order == 'label')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a class="black-text" rel="nofollow" href="{{ route('routesIndex') }}?order=grade&direction={{ ($order == 'grade') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/routes.columnGrade')
                                    @if($order == 'grade')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a class="black-text" rel="nofollow" href="{{ route('routesIndex') }}?order=note&direction={{ ($order == 'note') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/routes.columnNote')
                                    @if($order == 'note')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="text-center">
                                <a class="black-text" rel="nofollow" href="{{ route('routesIndex') }}?order=crag_id&direction={{ ($order == 'crag_id') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/routes.columnCrag')
                                    @if($order == 'crag_id')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="text-center">
                                <a class="black-text" rel="nofollow" href="{{ route('routesIndex') }}?order=created_at&direction={{ ($order == 'created_at') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/routes.columnCreated')
                                    @if($order == 'created_at')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($routes as $route)
                        <tr>
                            <td class="text-bold">
                                <a href="{{ route('routePage', ['route_id'=>$route->id, 'route_label'=>str_slug($route->label)]) }}">
                                    <img src="/img/climb-{{ $route->climb_id }}.png" alt="" class="left" height="12">
                                    {{ $route->label }}
                                </a>
                            </td>
                            <td>
                                @if(count($route->routeSections) == 1)
                                    <span class="color-grade-{{ $route->routeSections[0]->grade_val }}">
                                        {{ $route->routeSections[0]->grade . $route->routeSections[0]->sub_grade }}
                                    </span>
                                @else
                                    {{ count($route->routeSections) }} L.
                                @endif
                            </td>
                            <td><img src="/img/note_{{ $route->note }}.png" alt="" height="15"></td>
                            <td><a href="{{ route('cragPage', ['crag_id'=>$route->crag->id, 'crag_label'=>str_slug($route->crag->label)]) }}">{{ $route->crag->label }}</a></td>
                            <td>{{ $route->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $routes->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection
