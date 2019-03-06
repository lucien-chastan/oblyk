@extends('layouts.app',[
    'meta_title'=> trans('meta/home.title'),
    'meta_description'=>trans('meta/home.description'),
    'meta_img'=>'https://oblyk.org/img/meta_home.jpg',
])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/home.css" rel="stylesheet">
@endsection

@section('content')

    <div class="parallax-container">
        <div class="parallax">
            <img class="img-parallax-home" src="/img/oblyk-home-baume-rousse.jpg" alt="escalade à la falaise de baume rousse">
            <div class="div-entete-oblyk">
                <h1>Oblyk{{ env('APP_ENV') == 'beta' ? ' beta' :'' }}</h1>
                <p>@lang('home.slogan')</p>
            </div>
            <span class="credit-philippe">&copy; Philippe LATOURRETTE</span>
        </div>
    </div>

    <div class="container description-oblyk">
        <div class="partie-point-home">
            @if(env('APP_ENV') == 'beta')
                <div class="row">
                    <div class="col s12">
                        <p>
                            La version <strong>beta</strong> d'oblyk est une copie conforme de la <a href="https://oblyk.org">vrai version</a> mais avec un jour de retard par rapport à la base de donnée et avec des amélorations en plus à tester !<br>
                        </p>
                        <p class="text-center text-italic">
                            N'oubliez pas, tous ce que vous faite ici aujourd'hui sera effacé demain !
                        </p>
                    </div>
                </div>
            @endif

            {{-- Crag information --}}
            <div class="row">
                <div class="col s12 m6 l6">
                    <h2>@lang('home.titleCheckCragInformation')</h2>
                    <p class="explication-oblyk">@lang('home.descriptionCheckCragInformation')</p>
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('map') }}"><i class="material-icons left">map</i> @lang('home.actionCheckCragInformation')</a>
                    </p>
                </div>
                <div class="col s12 m6 l6 center">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.info_falaise')
                    </div>
                </div>
            </div>

            {{-- Crosses --}}
            <div class="row reverse-smartphone">
                <div class="col s12 m6 l6 order-1">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.carnet_croix')
                    </div>
                </div>
                <div class="col s12 m6 l6 order-2">
                    <h2>@lang('home.titleCrossBook')</h2>
                    <p class="explication-oblyk">@lang('home.descriptionCrossBook')</p>
                    @if(config('app.active_indoor'))
                        <p>
                            <span class="badge-new-in-home">New!</span> @lang('home.new-indoor')
                        </p>
                    @endif
                </div>
            </div>

            {{-- Partner --}}
            <div class="row">
                <div class="col s12 m6 l6">
                    <h2>@lang('home.titlePartner')</h2>
                    <p class="explication-oblyk">@lang('home.descriptionPartner')</p>
                    <p class="text-right">
                        <a class="btn-flat blue-text" href="{{ route('partnerHowPage') }}"><i class="material-icons left">person_pin</i>@lang('home.actionPartner')</a>
                    </p>
                </div>
                <div class="col s12 m6 l6">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.partenaire_grimpe')
                    </div>
                </div>
            </div>

            {{-- News feed --}}
            <div class="row reverse-smartphone">
                <div class="col s12 m6 l6 order-1">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.flux')
                    </div>
                </div>
                <div class="col s12 m6 l6 order-2">
                    <h2>@lang('home.titleNewsFeed')</h2>
                    <p class="explication-oblyk">@lang('home.descriptionNewsFeed')</p>
                </div>
            </div>

            {{-- Create account or support us --}}
            @if(Auth::guest())
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h2>@lang('home.titleAccount')</h2>
                        <p class="explication-oblyk">@lang('home.descriptionAccount')</p>
                        <p class="center">
                            <a href="{{ route('register') }}" class="waves-effect waves-light btn">@lang('home.actionAccount')</a>
                        </p>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="svg-container">
                            @include('pages.home.partials.svg.inscription')
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h2>@lang('pages/projects/supportUs.title')</h2>
                        <p class="explication-oblyk">@lang('pages/projects/supportUs.para_1')</p>
                        <p class="explication-oblyk">@lang('pages/projects/supportUs.para_2')</p>
                        <p class="explication-oblyk">@lang('pages/projects/supportUs.para_3')</p>
                        <p class="center">
                            <a href="{{ route('supportUs') }}" class="waves-effect waves-light btn">
                                <i class="material-icons left">favorite</i>
                                @lang('pages/projects/supportUs.title')
                            </a>
                        </p>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="svg-container">
                            @include('pages.home.partials.svg.inscription')
                        </div>
                    </div>
                </div>
            @endif

            {{-- Guidebook --}}
            <div class="row reverse-smartphone">
                <div class="col s12 m6 l6 order-1">
                    <div class="svg-container">
                        @include('pages.home.partials.svg.guidebook')
                    </div>
                </div>
                <div class="col s12 m6 l6 order-2">
                    <h2>@lang('home.titleGuidebook')</h2>
                    <p class="explication-oblyk">@lang('home.descriptionGuidebook')</p>
                    @if(Auth::guest())
                        <p class="center">
                            <a href="{{ route('register') }}" class="waves-effect waves-light btn">@lang('home.actionAccount')</a>
                        </p>
                    @endif
                </div>
            </div>

            {{-- Indoor --}}
            @if(config('app.active_indoor'))
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h2>@lang('home.titleIndoor')</h2>
                        <p class="explication-oblyk">@lang('home.descriptionIndoor')</p>
                        <p class="text-right">
                            <a class="btn-flat blue-text" href="{{ route('indoorPresentation') }}"><i class="material-icons left">home</i>@lang('home.actionPartner')</a>
                        </p>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="svg-container">
                            @include('pages.home.partials.svg.indoor')
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Community activity --}}
        @if($countActivity > 0)
            <div class="row">
                <div class="s12 m12 l12">
                    <h2 class="center">@lang('home.title-community-activity')</h2>
                </div>
            </div>
            <div class="activity-part-oblyk">
                <div class="row">
                     @include('pages.home.partials.community-activity')
                </div>
            </div>
        @endif

        <div class="row">
            <div class="s12 m12 l12">
                <h2 class="center">@lang('home.titleWhatUp')</h2>
            </div>
        </div>

        <div class="row">
            @foreach($articles as $article)
                <div class="col s12 m12 l4">
                    <div class="card hoverable">
                        <div class="card-image">
                            @if(file_exists(storage_path('app/public/articles/200/article-' . $article->id . '.jpg')))
                                <img src="/storage/articles/200/article-{{$article->id}}.jpg" alt="article {{$article->label}}">
                            @else
                                <img src="/img/default-article-bandeau.jpg" alt="article {{$article->label}}">
                            @endif
                        </div>
                        <div class="card-content">
                            <span title="{{$article->label}}" class="card-title truncate">{{$article->label}}</span>
                            <p>
                                {{ str_limit($article->description, $limit = 150, $end = '...') }}
                            </p>
                        </div>
                        <div class="card-action text-right">
                            <a href="{{ $article->url() }}">@lang('home.readMore')</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="text-right">
                <a class="btn-flat" href="{{ route('articlesPage') }}">@lang('home.seeArticles')</a>
            </div>
        </div>

        {{-- Oblyk numbers--}}
        <div class="row">
            <div class="col s12 m12 l12">
                <h2 class="center">@lang('home.titleInFigures')</h2>
            </div>
        </div>

        <div class="center partie-chiffre-oblyk">
            <div class="row oblyk-number blue-text">
                <div class="col s4 m4 l4">
                    {{ $nb_crags }} @if($nb_crags_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.crag_today', $nb_crags_today)) !!} class="tooltipped green-text">+{{ $nb_crags_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresCrags')</span>
                </div>
                <div class="col s4 m4 l4">
                    {{ $nb_users }} @if($nb_users_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.user_today', $nb_users_today)) !!} class="tooltipped green-text">+{{ $nb_users_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresClimbers')</span>
                </div>
                <div class="col s4 m4 l4">
                    {{ $nb_gyms }} @if($nb_gyms_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.gym_today', $nb_gyms_today)) !!} class="tooltipped green-text">+{{ $nb_gyms_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresGyms')</span>
                </div>
            </div>

            <div class="row oblyk-number">
                <div class="col s4 m4 l4">
                    {{ $nb_routes }} @if($nb_routes_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.route_today', $nb_routes_today)) !!} class="tooltipped green-text">+{{ $nb_routes_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresRoutes')</span>
                </div>
                <div class="col s4 m4 l4">
                    {{ $nb_crosses + $nb_indoor_crosses }} @if($nb_crosses_today + $nb_indoor_crosses_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.cross_today', $nb_crosses_today + $nb_indoor_crosses_today)) !!} class="tooltipped green-text">+{{ $nb_crosses_today + $nb_indoor_crosses_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresCrosses')</span>
                </div>
                <div class="col s4 m4 l4">
                    {{ $nb_photos }} @if($nb_photos_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.photo_today', $nb_photos_today)) !!} class="tooltipped green-text">+{{ $nb_photos_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresPhotos')</span>
                </div>
            </div>

            <div class="row oblyk-number">
                <div class="col s4 m4 l4">
                    {{ $nb_topos + $nb_topos_web + $nb_topos_pdf }} @if($nb_topos_today > 0 || $nb_topos_web_today > 0 || $nb_topos_pdf_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.topo_today', $nb_topos_today + $nb_topos_web_today + $nb_topos_pdf_today)) !!} class="tooltipped green-text">+{{ $nb_topos_today + $nb_topos_web_today + $nb_topos_pdf_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresGuideBooks')</span>
                </div>
                <div class="col s4 m4 l4">
                    {{ $nb_descriptions }} @if($nb_descriptions_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.description_today', $nb_descriptions_today)) !!} class="tooltipped green-text">+{{ $nb_descriptions_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresComments')</span>
                </div>
                <div class="col s4 m4 l4">
                    {{ $nb_videos }} @if($nb_videos_today > 0) <em {!! $Helpers::tooltip(trans_choice('home.video_today', $nb_videos_today)) !!} class="tooltipped green-text">+{{ $nb_videos_today }}</em> @endif<br>
                    <span class="loved-king-font">@lang('home.figuresVideos')</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="/js/home.js"></script>
@endsection