@extends('layouts.app',[
    'meta_title'=> trans('meta/gym-route.title', ['label'=>$route->name(), 'gym_label'=>$gym->label, 'id'=>$route->id]),
    'meta_description'=>trans('meta/gym-route.description', ['label'=>$route->name(), 'gym_label'=>$gym->label, 'id'=>$route->id]),
    'meta_img'=>'https://oblyk.org' . ($route->hasPicture()) ? $route->picture(500) : $gym->bandeau(),
    ])

@inject('Helpers','App\Lib\HelpersTemplates')

@section('css')
    <link href="/css/gym.css" rel="stylesheet">
    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.min.css">
    @endif
@endsection

@section('content')

    {{--parallax--}}
    @include('includes.gym-route-parallax', array(
        'imgSrc' => $gym->bandeau(),
        'imgAlt' => 'salle escalade ' . $gym->label,
    ))

    {{-- Content page --}}
    <div class="container">
        <div class="row">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m6 l7">
                        <table class="information-gym-route-table">
                            <tr>
                                <th colspan="2">
                                    <h1 class="loved-king-font title-gym-route">
                                        @if($route->hasThumbnail())
                                            <img class="circle left thumbnail-route-page" src="{{ $route->thumbnail() }}" alt="miniature de la ligne {{ $route->name() }}">
                                        @endif
                                        <div class="left" style="margin-right: 0.5em">
                                            @if($route->display_tag_color())
                                                <i title="Étiquettes" class="material-icons left" style="{{ $route->tag_color_style() }}; margin-right: 0">turned_in</i>
                                            @endif
                                            @if($route->display_hold_color())
                                                <i title="Prises" class="material-icons left" style="{{ $route->hold_color_style() }}; margin-right: 0">bubble_chart</i>
                                            @endif
                                        </div>
                                        {!! $route->grades('html', 'text-bold') !!}
                                        {{ $route->name() }}
                                        @if($route->favorite)
                                            <i class="material-icons right red-text">favorite</i>
                                        @endif
                                    </h1>
                                </th>
                            </tr>
                            @if($route->hasDescription())
                                <tr>
                                    <td colspan="2">
                                        {{ $route->description }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.type') :</th>
                                <td>{!! $route->formatted_type('text-bold') !!}</td>
                            </tr>
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.height') :</th>
                                <td>
                                    @foreach($route->heights() as $height)
                                        {{ $height }}m
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.ascent') :</th>
                                <td>@choice('pages/gym-schemes/global.number_ascent', $route->number_of_ascents())</td>
                            </tr>
                            @if($route->opener)
                                <tr>
                                    <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.openedBy'):
                                    </th>
                                    <td>
                                        {{ $route->opener }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.openedAt') :</th>
                                <td>
                                    {{ $route->opener_date->format('d/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gyms/global.gym') :</th>
                                <td>
                                    <a href="{{ $gym->url() }}">
                                        <img src="{{ $gym->logo() }}" alt="logo de la salle de {{ $gym->label }}" style="margin-right: 5px" height="22" class="left">
                                        {{ $gym->label }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gyms/global.guideBook') :</th>
                                <td>
                                    <a href="{{ $route->sector->room->url() }}">
                                        {{ $route->sector->room->label }}
                                    </a>
                                    , @lang('pages/gyms/global.sector') : <a href="{{ $route->sector->room->url() }}#sector-{{ $route->sector->id }}">{{ $route->sector->label }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th width="10" class="no-warp text-right">@lang('pages/gyms/global.seeOnGuideBook') :</th>
                                <td>
                                    <a href="{{ $route->sector->room->url() }}#line-{{ $route->id }}">
                                        @lang('pages/gyms/global.guideBook')
                                    </a>
                                </td>
                            </tr>
                            @if($route->isDismounted())
                                <tr>
                                    <th width="10" class="no-warp text-right">@lang('pages/gym-schemes/global.dismounted_at') :
                                    </th>
                                    <td>
                                        {{ $route->dismounted_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col s12 m6 l5">
                        @if($route->hasPicture())
                            <img src="{{ $route->picture(1300) }}" class="responsive-img" alt="photo voie d'escalade">
                        @else
                            <p class="grey-text text-center text-italic">@lang('pages/gyms/global.has_no_photo')</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    @if(count($route->descriptions) > 0)
                        <div class="col s12">
                            <div class="blue-border-zone">
                                @foreach ($route->descriptions as $description)
                                    <div class="blue-border-div">
                                        <div class="markdownZone">{{ $description->description }}</div>
                                        <p class="info-user grey-text">
                                            @lang('modals/description.postByDate', ['name'=>$description->user->name, 'url'=>$description->user->url(), 'date'=>$description->created_at->format('d M Y')])
                                            @if(Auth::check())
                                                <i {!! $Helpers::tooltip(trans('modals/problem.tooltip')) !!} {!! $Helpers::modal(route('problemModal'), ["id" => $description->id , "model"=> "Description"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">flag</i>
                                                @if($description->user_id == Auth::id())
                                                    <i {!! $Helpers::tooltip(trans('modals/description.editTooltip')) !!} {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>"GymRoute", "description_id"=>$description->id, "title"=>trans('modals/description.modalEditeTitle'), "method" => "PUT", "callback"=>"location.reload()"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">edit</i>
                                                    <i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/descriptions/".$description->id, "callback"=>"location.reload()"]) !!} class="material-icons tiny-btn right tooltipped btnModal" onclick="$('#modal').modal('open');">delete</i>
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(Auth::check())
                        <div class="text-center">
                            <button {!! $Helpers::modal(route('descriptionModal'), ["descriptive_id"=>$route->id, "descriptive_type"=>'GymRoute', "description_id"=>"", "title"=>trans('modals/comment.addTooltip'), "method"=>"POST", "callback"=>"location.reload()"]) !!} class="btn btn-flat btnModal">@lang('modals/comment.addTooltip')<i class="material-icons left">comment</i></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Cross --}}
        @if(Auth::check())
            <div class="row">
                <div class="card-panel">
                    <div class="row">
                        <div class="col s12">
                            @if(count($crosses) > 0)
                                <p class="grey-text text-underline">@lang('pages/gym-schemes/global.crossesTitle')</p>
                                <div class="blue-border-zone">
                                    @foreach($crosses as $cross)
                                        <div class="blue-border-div">
                                            <p>
                                                @lang('elements/statuses.status_' . $cross->status_id) le {{ $cross->release_at->format('d/m/Y') }}, fait en @lang('elements/modes.mode_' . $cross->mode_id)
                                                <i {!! $Helpers::modal(route('indoorCrossModal'), ["id" => $cross->id, "route_id"=>$route->id, "room_id"=>$route->sector->room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.editCross'), "method"=>"PUT", 'callback'=>'location.reload()']) !!} style="font-size: 1.1em" class="material-icons right btnModal">edit</i>
                                                <i {!! $Helpers::modal(route('deleteModal'), ["route" => "/indoor_crosses/".$cross->id, 'callback'=>'location.reload()']) !!} style="font-size: 1.1em" class="material-icons right btnModal red-text">delete</i>
                                            </p>
                                            @if($cross->description != null)
                                                <div class="markdownZone">@markdown($cross->description)</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="text-center">
                                <button {!! $Helpers::modal(route('indoorCrossModal'), ["id" => "", "route_id"=>$route->id, "room_id"=>$route->sector->room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.addCross'), "method"=>"POST", 'callback'=>'location.reload()']) !!} class="btn btn-flat btn btnModal">
                                    @if(count($crosses) == 0)
                                        @lang('pages/gym-schemes/global.addCross')
                                    @else
                                        @lang('pages/gym-schemes/global.addRepetitionCross')
                                    @endif
                                    <i class="material-icons left">done</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
            <div class="row stretchCol">
                <div class="card-panel">
                    <div class="col s12">
                        <p>
                            <i class="material-icons left blue-text">settings</i><strong>@lang('pages/gym-schemes/global.administrationTitle')</strong>
                        </p>
                        <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => $route->id, "room_id"=>$route->sector->room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=> trans('pages/gym-schemes/global.editRoute'), "method"=>"PUT", 'callback'=>'location.reload()']) !!} class="btn btn-flat btn btnModal">
                            @lang('pages/gym-schemes/global.editRoute')
                            <i class="material-icons left">edit</i>
                        </button>
                        <button {!! $Helpers::modal(route('routeUploadSchemeModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadPicture'), "method"=>"POST", 'callback'=>'location.reload()']) !!} class="btn btn-flat btn btnModal">
                            @lang('pages/gym-schemes/global.uploadPicture')
                            <i class="material-icons left">photo_camera</i>
                        </button>
                        <button {!! $Helpers::modal(route('routeUploadThumbnailModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.uploadThumbnail'), "method"=>"POST", 'callback'=>'location.reload()']) !!} class="btn btn-flat btn btnModal">
                            @lang('pages/gym-schemes/global.uploadThumbnail')
                            <i class="material-icons left">crop_original</i>
                        </button>
                        @if($route->hasPicture())
                            <button {!! $Helpers::modal(route('cropGymRouteModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=> trans('pages/gym-schemes/global.cropThumbnail'), "method"=>"POST", 'callback'=>'location.reload()']) !!} class="btn btn-flat btn btnModal">
                                @lang('pages/gym-schemes/global.cropThumbnail')
                                <i class="material-icons left">crop</i>
                            </button>
                        @endif
                        <button class="btn btn-flat btn" onclick="dismountRoute({{ $route->id }})">
                            @if($route->dismounted_at == null)
                                @lang('pages/gym-schemes/global.dismountRoute')
                                <i class="material-icons left">reply</i>
                            @else
                                @lang('pages/gym-schemes/global.riseUpRoute')
                                <i class="material-icons left">keyboard_capslock</i>
                            @endif
                        </button>
                        <button class="btn btn-flat btn" onclick="favoriteRoute({{ $route->id }})">
                            @if($route->favorite)
                                @lang('pages/gym-schemes/global.favoriteRoute')
                                <i class="material-icons left red-text">favorite</i>
                            @else
                                @lang('pages/gym-schemes/global.upToFavoriteRoute')
                                <i class="material-icons left">favorite_border</i>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('script')
    <script>
        convertMarkdownZone();
    </script>
    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <script src="/js/gym-edit-scheme.js"></script>
        <script src="/js/gym-upload-scheme.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.min.js"></script>
        <script>
            var current_route_id = {{ $route->id }}
        </script>
    @endif
@endsection