@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_gyms'),
    'meta_description'=>trans('meta/tools.description_gyms'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/gyms.title')</h1>
                <p class="grey-text text-center">@choice('pages/tools/gyms.nbGyms', $nb)</p>

                <table class="centered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <a class="black-text" rel="nofollow" href="{{ route('gymsIndex') }}?order=label&direction={{ ($order == 'label') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/gyms.columnLabel')
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
                                <a class="black-text" rel="nofollow" href="{{ route('gymsIndex') }}?order=city&direction={{ ($order == 'city') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/gyms.columnCity')
                                    @if($order == 'city')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="text-center">
                                <a class="black-text" rel="nofollow" href="{{ route('gymsIndex') }}?order=code_country&direction={{ ($order == 'code_country') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/gyms.columnCountry')
                                    @if($order == 'code_country')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="text-center">
                                <a class="black-text" rel="nofollow" href="{{ route('gymsIndex') }}?order=created_at&direction={{ ($order == 'created_at') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/gyms.columnCreated')
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
                    @foreach($gyms as $gym)
                        <tr>
                            <td><img src="{{ (file_exists(storage_path('app/public/gyms/100/logo-' . $gym->id . '.png')) ? '/storage/gyms/100/logo-' . $gym->id . '.png' : '/img/icon-gym.svg') }}" class="max-min-img"></td>
                            <td class="text-bold">
                                <a href="{{ route('gymPage', ['gym_id'=>$gym->id, 'gym_label'=>str_slug($gym->label)]) }}">
                                    <img src="/img/marker-sae-{{ $gym->type_boulder . $gym->type_route }}.svg" alt="" class="left" height="25">
                                    {{ $gym->label }}
                                </a>
                            </td>
                            <td><a href="{{ route('map') }}#{{$gym->lat}}/{{$gym->lng}}/15">{{ $gym->city }}</a></td>
                            <td>{{ $gym->code_country }}</td>
                            <td>{{ $gym->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $gyms->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection
