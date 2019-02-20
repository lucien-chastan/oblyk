@extends('layouts.app',[
    'meta_title'=> trans('meta/indoor.title'),
    'meta_description'=>trans('meta/indoor.description'),
    'meta_img'=>'https://oblyk.org/img/map_meta.jpg',
    ])

@section('css')
    <link href="/css/indoor.css" rel="stylesheet">
@endsection

@section('content')

    {{-- Parallax --}}
    @include('includes.parallax', array('imgSrc' => '/img/oblyk-home-baume-rousse.jpg', 'imgAlt' => 'Falaise de baume rousse'))

    <div class="container">
        <div class="row row-how-indoor">
            <div class="col s12">
                <h1 class="loved-king-font text-center grey-text text-darken-3 titre-1-indoor">@lang('pages/projects/indoor.title')</h1>
                <p class="text-center">
                    @lang('pages/projects/indoor.intro')
                </p>
            </div>
        </div>

        {{-- Create interactive guidebook --}}
        <div class="row row-how-indoor">
            <div class="col s12 m12 l6 div-svg-indoor">
                <img src="/img/indoor-guidebook.svg" alt="TODO">
            </div>
            <div class="col s12 m12 l6">
                <h3 class="loved-king-font">@lang('pages/projects/indoor.guidebook_title') <span class="badge-price teal lighten-3 over-head">@lang('pages/projects/indoor.option_standard')</span></h3>
                <p>@lang('pages/projects/indoor.guidebook_para_1')</p>
                <p class="text-italic grey-text text-darken-1">"@lang('pages/projects/indoor.guidebook_para_2')"</p>

                <p class="text-underline text-bold">@lang('pages/projects/indoor.guidebook_option_title') <span class="badge-price deep-purple lighten-3 over-head">@lang('pages/projects/indoor.option_pro')</span></p>
                <p>@lang('pages/projects/indoor.guidebook_option_para_1')</p>
            </div>
        </div>

        {{-- Organize contest --}}
        <div class="row row-how-indoor">
            <div class="col s12 m12 l6">
                <h3 class="loved-king-font">@lang('pages/projects/indoor.contest_title') <span class="badge-price deep-purple lighten-3 over-head">@lang('pages/projects/indoor.option_pro')</span></h3>
                <p>@lang('pages/projects/indoor.contest_para_1')</p>
                <p>@lang('pages/projects/indoor.contest_para_2')</p>
            </div>
            <div class="col s12 m12 l6 div-svg-indoor">
                <img src="/img/indoor-contest.svg" alt="TODO">
            </div>
        </div>

        {{-- Manage your PPE --}}
        <div class="row row-how-indoor">
            <div class="col s12 m12 l6 div-svg-indoor">
                <img src="/img/indoor-ppe.svg" alt="TODO">
            </div>
            <div class="col s12 m12 l6">
                <h3 class="loved-king-font">@lang('pages/projects/indoor.ppe_title') <span class="badge-price yellow darken-2 over-head">@lang('pages/projects/indoor.option_premium')</span></h3>
                <p>@lang('pages/projects/indoor.ppe_para_1')</p>
                <p>@lang('pages/projects/indoor.ppe_para_2')</p>
            </div>
        </div>

        {{-- Statistique --}}
        <div class="row row-how-indoor">
            <div class="col s12 m12 l6">
                <h3 class="loved-king-font">@lang('pages/projects/indoor.statistic_title') <span class="badge-price yellow darken-2 over-head">@lang('pages/projects/indoor.option_premium')</span></h3>
                <p>@lang('pages/projects/indoor.statistic_para_1')</p>
            </div>
            <div class="col s12 m12 l6 div-svg-indoor">
                <img src="/img/indoor-statistic.svg" alt="TODO">
            </div>
        </div>

        {{-- Pricing --}}
        <table class="highlight">
            <thead>
                <tr>
                    <th>@lang('pages/projects/indoor.option')</th>
                    <th class="text-center"><span class="badge-price teal lighten-3">@lang('pages/projects/indoor.option_standard')</span></th>
                    <th class="text-center"><span class="badge-price yellow darken-2">@lang('pages/projects/indoor.option_premium')</span></th>
                    <th class="text-center"><span class="badge-price deep-purple lighten-3">@lang('pages/projects/indoor.option_pro')</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <i class="material-icons left">vertical_split</i>
                        @lang('pages/projects/indoor.option_guidebook')
                    </td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                </tr>
                <tr>
                    <td>
                        <i class="material-icons left">equalizer</i>
                        @lang('pages/projects/indoor.option_statistic')
                    </td>
                    <td class="text-center"><i class="material-icons red-text">close</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                </tr>
                <tr>
                    <td>
                        <i class="material-icons left">av_timer</i>
                        @lang('pages/projects/indoor.option_ppe')
                    </td>
                    <td class="text-center"><i class="material-icons red-text">close</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                </tr>
                <tr>
                    <td>
                        <i class="material-icons left">style</i>
                        @lang('pages/projects/indoor.option_tag')
                    </td>
                    <td class="text-center"><i class="material-icons red-text">close</i></td>
                    <td class="text-center"><i class="material-icons red-text">close</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                </tr>
                <tr>
                    <td>
                        <i class="material-icons left">star</i>
                        @lang('pages/projects/indoor.option_contest')
                    </td>
                    <td class="text-center"><i class="material-icons red-text">close</i></td>
                    <td class="text-center"><i class="material-icons red-text">close</i></td>
                    <td class="text-center"><i class="material-icons green-text">check</i></td>
                </tr>
                <tr>
                    <th></th>
                    <th class="text-center">@lang('pages/projects/indoor.option_free')</th>
                    <th class="text-center">15 €/@lang('pages/projects/indoor.option_by_month')</th>
                    <th class="text-center">35 €/@lang('pages/projects/indoor.option_by_month')</th>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center" colspan="3">
                        <a class="btn btn-primary" href="mailto:{{ env('MAIL_USERNAME') }}">@lang('pages/projects/indoor.contact')</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="text-bold text-center grey-text">@lang('pages/projects/indoor.price_detail')</p>
    </div>
@endsection
