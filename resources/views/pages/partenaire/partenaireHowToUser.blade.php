@extends('layouts.app',[
    'meta_title'=> trans('meta/partner.title_howToUse'),
    'meta_description'=>trans('meta/partner.description_howToUse'),
    'meta_img'=>'https://oblyk.org/img/map_meta.jpg',
    ])

@section('css')
    <link href="/css/partner-how.css" rel="stylesheet">
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    {{--contenu de la page--}}
    <div class="container">
        <div class="row row-how-partner">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3 titre-1-partner">@lang('pages/partner/partnerHowToUser.bigTitle')</h1>
                <h2 class="loved-king-font text-center grey-text text-darken-2 titre-2-partner">@lang('pages/partner/partnerHowToUser.slogan')</h2>

                <p class="text-center">
                    @lang('pages/partner/partnerHowToUser.intro')
                </p>

                @if(!Auth::check())
                    <p class="text-center">
                        @lang('pages/partner/partnerHowToUser.introNoCompte')<br>
                    </p>
                    <p class="text-center">
                        <a class="btn" href="{{ route('register') }}">@lang('pages/partner/partnerHowToUser.registerAction')</a><br>
                        <a href="{{ route('login') }}">@lang('pages/partner/partnerHowToUser.loginAction')</a>
                    </p>
                @endif
            </div>
        </div>


        {{--ÉTAPE 1 : PRÉFÉRENCES--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-1.svg" alt="des montagnes et différents représentation de l'escalade">
            </div>

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">@lang('pages/partner/partnerHowToUser.title_step_1')</p>
                <p>@lang('pages/partner/partnerHowToUser.description_step_1')</p>
                @if(Auth::check())
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('userPage',['user_id'=>Auth::id(), 'user_label'=>str_slug(Auth::user()->name)]) }}#partenaire-parametres"><i class="material-icons left">accessibility</i>@lang('pages/partner/partnerHowToUser.action_step_1')</a>
                    </p>
                @endif
            </div>
        </div>

        {{--ÉTAPE 2 : MES LIEUX DE GRIMPE--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">@lang('pages/partner/partnerHowToUser.title_step_2')</p>
                <p>
                    @lang('pages/partner/partnerHowToUser.description_step_2')
                </p>
                @if(Auth::check())
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('userPage',['user_id'=>Auth::id(), 'user_label'=>str_slug(Auth::user()->name)]) }}#mes-lieux"><i class="material-icons left">location_on</i>@lang('pages/partner/partnerHowToUser.action_step_2')</a>
                    </p>
                @endif
            </div>

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-2.svg" alt="des montagnes avec des marqueurs partout">
            </div>

        </div>

        {{--ÉTAPE 3 : LA CARTE DES GRIMPEURS--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-3.svg" alt="zone partagée sur la recherche de partenaire">
            </div>

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">@lang('pages/partner/partnerHowToUser.title_step_3')</p>
                <p>@lang('pages/partner/partnerHowToUser.description_step_3')</p>
                <p class="text-right">
                    <a class="btn-flat blue-text" href="{{ route('partnerMapPage') }}"><i class="material-icons left">map</i>@lang('pages/partner/partnerHowToUser.action_step_3')</a>
                </p>
            </div>
        </div>

        {{--ÉTAPE 4 : CONTACT--}}
        <div class="row row-how-partner">

            <div class="col s12 m12 l6">
                <p class="text-underline text-bold">@lang('pages/partner/partnerHowToUser.title_step_4')</p>
                <p>
                    @lang('pages/partner/partnerHowToUser.description_step_4')
                </p>
                @if(Auth::check())
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('userPage',['user_id'=>Auth::id(), 'user_label'=>str_slug(Auth::user()->name)]) }}#messagerie"><i class="material-icons left">email</i> @lang('pages/partner/partnerHowToUser.action_step_4')</a>
                    </p>
                @endif
            </div>

            <div class="col s12 m12 l6 div-svg-partner">
                <img src="/img/partner-etape-4.svg" alt="deux grimpeurs se rencontre">
            </div>

        </div>
    </div>

@endsection
