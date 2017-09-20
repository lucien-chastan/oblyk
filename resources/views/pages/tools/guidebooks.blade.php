@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_guidebooks'),
    'meta_description'=>trans('meta/tools.description_guidebooks'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/guidebooks.title')</h1>
                <p class="grey-text text-center">@choice('pages/tools/guidebooks.nbGuidebooks', $nb)</p>

                <table class="centered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <a class="black-text" rel="nofollow" href="{{ route('guidebooksIndex') }}?order=label&direction={{ ($order == 'label') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/guidebooks.columnLabel')
                                @if($order == 'label')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('guidebooksIndex') }}?order=author&direction={{ ($order == 'author') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/guidebooks.columnAuthor')
                                @if($order == 'author')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('guidebooksIndex') }}?order=editor&direction={{ ($order == 'editor') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/guidebooks.columnEditor')
                                @if($order == 'editor')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('guidebooksIndex') }}?order=editionYear&direction={{ ($order == 'editionYear') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/guidebooks.columnEditionYear')
                                @if($order == 'editionYear')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('guidebooksIndex') }}?order=created_at&direction={{ ($order == 'created_at') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/guidebooks.columnCreated')
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
                    @foreach($guidebooks as $guidebook)
                        <tr>
                            <td><img src="{{ (file_exists(storage_path('app/public/topos/100/topo-' . $guidebook->id . '.jpg')) ? '/storage/topos/100/topo-' . $guidebook->id . '.jpg' : '/img/icon-search-guidebook.svg') }}" class="max-min-img"></td>
                            <td class="text-bold">
                                <a href="{{ route('topoPage', ['topo_id'=>$guidebook->id, 'topo_label'=>str_slug($guidebook->label)]) }}">
                                    {{ $guidebook->label }}
                                </a>
                            </td>
                            <td>{{ $guidebook->author }}</td>
                            <td>{{ $guidebook->editor }}</td>
                            <td>{{ $guidebook->editionYear }}</td>
                            <td>{{ $guidebook->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $guidebooks->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection
