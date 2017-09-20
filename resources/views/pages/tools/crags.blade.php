@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_crags'),
    'meta_description'=>trans('meta/tools.description_crags'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/crags.title')</h1>
                <p class="grey-text text-center">@choice('pages/tools/crags.nbCrags', $nb)</p>

                <table class="centered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <a class="black-text" rel="nofollow" href="{{ route('cragsIndex') }}?order=label&direction={{ ($order == 'label') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/crags.columnLabel')
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
                                <a class="black-text" rel="nofollow" href="{{ route('cragsIndex') }}?order=city&direction={{ ($order == 'city') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/crags.columnCity')
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
                                <a class="black-text" rel="nofollow" href="{{ route('cragsIndex') }}?order=code_country&direction={{ ($order == 'code_country') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/crags.columnCountry')
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
                                <a class="black-text" rel="nofollow" href="{{ route('cragsIndex') }}?order=rock_id&direction={{ ($order == 'rock_id') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/crags.columnRock')
                                    @if($order == 'rock_id')
                                        @if($direction == 'ASC')
                                            <i class="material-icons right">keyboard_arrow_down</i>
                                        @else
                                            <i class="material-icons right">keyboard_arrow_up</i>
                                        @endif
                                    @endif
                                </a>
                            </th>
                            <th class="text-center">
                                <a class="black-text" rel="nofollow" href="{{ route('cragsIndex') }}?order=created_at&direction={{ ($order == 'created_at') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/crags.columnCreated')
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
                    @foreach($crags as $crag)
                        <tr>
                            <td><img src="{{ ($crag->bandeau != '/img/default-crag-bandeau.jpg') ? str_replace('1300', '50', $crag->bandeau) : '/img/default-crag-bandeau.jpg' }}" class="circle circle-img"></td>
                            <td class="text-bold">
                                <a href="{{ route('cragPage', ['crag_id'=>$crag->id, 'crag_label'=>str_slug($crag->label)]) }}">
                                    <img src="/img/marker-{{ $crag->type_voie . $crag->type_grande_voie . $crag->type_bloc . $crag->type_deep_water . $crag->type_via_ferrata }}.svg" alt="" class="left" height="25">
                                    {{ $crag->label }}
                                </a>
                            </td>
                            <td><a href="{{ route('map') }}#{{$crag->lat}}/{{$crag->lng}}/15">{{ $crag->city }}</a></td>
                            <td>{{ $crag->code_country }}</td>
                            <td>@lang('elements/rocks.rock_' . $crag->rock_id)</td>
                            <td>{{ $crag->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $crags->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection
