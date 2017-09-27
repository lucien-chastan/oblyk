@extends('layouts.app', [
    'meta_title'=> trans('meta/project.title_termsOfUse'),
    'meta_description'=>trans('meta/project.description_termsOfUse'),
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
                <h1 class="loved-king-font text-center grey-text text-darken-3">@lang('pages/projects/termsOfUse.title')</h1>

                <h2 class="titre-2-terms" id="sommaire">@lang('pages/projects/termsOfUse.summary')</h2>

                <ul class="sommaire-mention">
                    <li><a class="lien_mentions_sommaire" href="#article_1">@lang('pages/projects/termsOfUse.article_1')</a></li>
                    <li><a class="lien_mentions_sommaire" href="#article_2">@lang('pages/projects/termsOfUse.article_2')</a></li>
                    <li><a class="lien_mentions_sommaire" href="#article_3">@lang('pages/projects/termsOfUse.article_3')</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_3_1">@lang('pages/projects/termsOfUse.article_3_1')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_3_2">@lang('pages/projects/termsOfUse.article_3_2')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_3_3">@lang('pages/projects/termsOfUse.article_3_3')</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_4">@lang('pages/projects/termsOfUse.article_4')</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_4_1">@lang('pages/projects/termsOfUse.article_4_1')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_4_2">@lang('pages/projects/termsOfUse.article_4_2')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_4_3">@lang('pages/projects/termsOfUse.article_4_3')</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_5">@lang('pages/projects/termsOfUse.article_5')</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_5_1">@lang('pages/projects/termsOfUse.article_5_1')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_5_2">@lang('pages/projects/termsOfUse.article_5_2')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_5_3">@lang('pages/projects/termsOfUse.article_5_3')</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_6">@lang('pages/projects/termsOfUse.article_6')</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_6_1">@lang('pages/projects/termsOfUse.article_6_1')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_6_2">@lang('pages/projects/termsOfUse.article_6_2')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_6_3">@lang('pages/projects/termsOfUse.article_6_3')</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_7">@lang('pages/projects/termsOfUse.article_7')</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_7_1">@lang('pages/projects/termsOfUse.article_7_1')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_7_2">@lang('pages/projects/termsOfUse.article_7_2')</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_8">@lang('pages/projects/termsOfUse.article_8')</a></li>
                    <li class="li_sous_menu_mentions">
                        <ul class="sous_sommaire_mentions">
                            <li><a class="lien_mentions_sommaire" href="#article_8_1">@lang('pages/projects/termsOfUse.article_8_1')</a></li>
                            <li><a class="lien_mentions_sommaire" href="#article_8_2">@lang('pages/projects/termsOfUse.article_8_2')</a></li>
                        </ul>
                    </li>
                    <li><a class="lien_mentions_sommaire" href="#article_9">@lang('pages/projects/termsOfUse.article_9')</a></li>
                </ul>


                <h2 class="titre-2-terms" id="article_1">@lang('pages/projects/termsOfUse.article_1')  <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_1_1')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_1_2')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_1_3')</p>

                <h2 class="titre-2-terms" id="article_2">@lang('pages/projects/termsOfUse.article_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_2_1')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_2_2')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_2_3')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_2_4')</p>

                <h2 class="titre-2-terms" id="article_3">@lang('pages/projects/termsOfUse.article_3') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <h3 class="h3-mentions" id="article_3_1">@lang('pages/projects/termsOfUse.article_3_1') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_3_1_1')</p>

                <h3 class="h3-mentions" id="article_3_2">@lang('pages/projects/termsOfUse.article_3_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_3_2_1')</p>

                <ul class="oblyk-ul">
                    <li>@lang('pages/projects/termsOfUse.li_3_2_1')</li>
                    <li>@lang('pages/projects/termsOfUse.li_3_2_2')</li>
                    <li>@lang('pages/projects/termsOfUse.li_3_2_3')</li>
                    <li>@lang('pages/projects/termsOfUse.li_3_2_4')</li>
                    <li>@lang('pages/projects/termsOfUse.li_3_2_5')</li>
                    <li>@lang('pages/projects/termsOfUse.li_3_2_6')</li>
                </ul>

                <h3 class="h3-mentions" id="article_3_3">@lang('pages/projects/termsOfUse.article_3_3') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_3_3_1')</p>

                <h2 class="titre-2-terms" id="article_4">@lang('pages/projects/termsOfUse.article_4') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <h3 class="h3-mentions" id="article_4_1">@lang('pages/projects/termsOfUse.article_4_1') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_4_1_1')</p>

                <h3 class="h3-mentions" id="article_4_2">@lang('pages/projects/termsOfUse.article_4_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_4_2_1')</p>

                <h3 class="h3-mentions" id="article_4_3">@lang('pages/projects/termsOfUse.article_4_3') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_4_3_1')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_4_3_2')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_4_3_3')</p>

                <h2 class="titre-2-terms" id="article_5">@lang('pages/projects/termsOfUse.article_5') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <h3 class="h3-mentions" id="article_5_1">@lang('pages/projects/termsOfUse.article_5_1') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_1_1')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_1_2')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_1_3')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_1_4')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_1_5')</p>

                <h3 class="h3-mentions" id="article_5_2">@lang('pages/projects/termsOfUse.article_5_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_2_1')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_2_2')</p>

                <h3 class="h3-mentions" id="article_5_3">@lang('pages/projects/termsOfUse.article_5_3') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_3_1')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_3_2')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_3_3')</p>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_5_3_4')</p>

                <h2 class="titre-2-terms" id="article_6">@lang('pages/projects/termsOfUse.article_6') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <cite class="red-text">@lang('pages/projects/termsOfUse.para_6_1')</cite>

                <h3 class="h3-mentions" id="article_6_1">@lang('pages/projects/termsOfUse.article_6_1') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_6_1_1')</p>

                <h3 class="h3-mentions" id="article_6_2">@lang('pages/projects/termsOfUse.article_6_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_6_2_1')</p>

                <h3 class="h3-mentions" id="article_6_3">@lang('pages/projects/termsOfUse.article_6_3') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_6_3_1')</p>
                <cite class="red-text">@lang('pages/projects/termsOfUse.para_6_3_2')</cite>
                <p class="para_mention">@lang('pages/projects/termsOfUse.para_6_3_3')</p>

                <h2 class="titre-2-terms" id="article_7">@lang('pages/projects/termsOfUse.article_7') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <h3 class="h3-mentions" id="article_7_1">@lang('pages/projects/termsOfUse.article_7_1') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_7_1_1')</p>

                <ul class="oblyk-ul">
                    <li>@lang('pages/projects/termsOfUse.li_7_1_1')</li>
                    <li>@lang('pages/projects/termsOfUse.li_7_1_2')</li>
                    <li>@lang('pages/projects/termsOfUse.li_7_1_3')</li>
                </ul>

                <h3 class="h3-mentions" id="article_7_2">@lang('pages/projects/termsOfUse.article_7_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_7_2_1')</p>

                <h2 class="titre-2-terms" id="article_8">@lang('pages/projects/termsOfUse.article_8') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <h3 class="h3-mentions" id="article_8_1">@lang('pages/projects/termsOfUse.article_8_1') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_8_1_1')</p>

                <h3 class="h3-mentions" id="article_8_2">@lang('pages/projects/termsOfUse.article_8_2') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h3>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_8_2_1')</p>

                <h2 class="titre-2-terms" id="article_9">@lang('pages/projects/termsOfUse.article_9') <a class="lien-vers-sommaire" href="#sommaire">(@lang('pages/projects/termsOfUse.summary_link'))</a></h2>

                <p class="para_mention">@lang('pages/projects/termsOfUse.para_9_1')</p>

            </div>
        </div>
    </div>

@endsection
