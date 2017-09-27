@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_groups'),
    'meta_description'=>trans('meta/tools.description_groups'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/groups.title')</h1>
                <p class="grey-text text-center">@choice('pages/tools/groups.nbGroups', $nb)</p>

                <table class="centered">
                    <thead>
                        <tr>
                            <th>
                                <a class="black-text" rel="nofollow" href="{{ route('groupsIndex') }}?order=label&direction={{ ($order == 'label') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                    @lang('pages/tools/groups.columnLabel')
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
                                <a class="black-text" rel="nofollow" href="{{ route('groupsIndex') }}?order=created_at&direction={{ ($order == 'created_at') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
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
                    @foreach($groups as $group)
                        <tr>
                            <td class="text-bold"><a href="{{ route('massivePage', ['massive_id'=>$group->id, 'massive_label'=>str_slug($group->label)]) }}">{{ $group->label }}</a></td>
                            <td>{{ $group->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $groups->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection
