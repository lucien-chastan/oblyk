@extends('layouts.app', [
    'meta_title'=> trans('meta/auth.title_confirm_delete'),
    'meta_description'=> trans('meta/auth.description_confirm_delete'),
    'meta_img'=>'/img/meta_home.jpg',
    ])

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--formulaire de connexion--}}
    <div class="container">
        <div class="row">
            <div class="col s12 m8 l8 offset-m2 offset-l2">

                {{--titre--}}
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/profile/deleteUser.titleAccountDeleted')</h1>

                <p class="text-center">
                    @lang('pages/profile/deleteUser.paraAccountDeleted')
                </p>

            </div>
        </div>
    </div>
@endsection
