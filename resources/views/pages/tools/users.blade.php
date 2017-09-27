@extends('layouts.app', [
    'meta_title'=> trans('meta/tools.title_climbers'),
    'meta_description'=>trans('meta/tools.description_climbers'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/tools/users.title')</h1>
                <p class="grey-text text-center">@choice('pages/tools/users.nbGyms', $nb)</p>

                <table class="centered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <a class="black-text" rel="nofollow" href="{{ route('usersIndex') }}?order=name&direction={{ ($order == 'name') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/users.columnLabel')
                                @if($order == 'name')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('usersIndex') }}?order=localisation&direction={{ ($order == 'localisation') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/users.columnLocalisation')
                                @if($order == 'localisation')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('usersIndex') }}?order=birth&direction={{ ($order == 'birth') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/users.columnAge')
                                @if($order == 'birth')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('usersIndex') }}?order=sex&direction={{ ($order == 'sex') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/users.columnGenre')
                                @if($order == 'sex')
                                    @if($direction == 'ASC')
                                        <i class="material-icons right">keyboard_arrow_down</i>
                                    @else
                                        <i class="material-icons right">keyboard_arrow_up</i>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center">
                            <a class="black-text" rel="nofollow" href="{{ route('usersIndex') }}?order=created_at&direction={{ ($order == 'created_at') ? ($direction == 'ASC') ? 'DESC' : 'ASC' : 'ASC' }}">
                                @lang('pages/tools/users.columnCreated')
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
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{ (file_exists(storage_path('app/public/users/100/user-' . $user->id . '.jpg')) ? '/storage/users/100/user-' . $user->id . '.jpg' : '/img/icon-search-user.svg') }}" class="circle max-min-img"></td>
                            <td class="text-bold">
                                <a href="{{ route('userPage', ['user_id'=>$user->id, 'user_label'=>str_slug($user->name)]) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->localisation }}</td>
                            <td>
                                @if($user->birth != 0)
                                    {{ date('Y') - $user->birth }} ans
                                @else
                                    ?
                                @endif
                            </td>
                            <td>
                                @if($user->sex != null)
                                    @lang('elements/sex.sex_' . $user->sex)
                                @else
                                    @lang('elements/sex.sex_0')
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $users->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>

@endsection
