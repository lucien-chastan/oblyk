@inject('Helpers','App\Lib\HelpersTemplates')
<div class="row title-and-return">
    <div class="col s12">
        <div class="col s5">
            <h5 class="loved-king-font no-warp">
                @if($route->hasThumbnail())
                    <img src="{{ $route->thumbnail() }}" class="circle left thumbnail-route">
                @endif
                <div class="left">
                    @foreach($route->colors() as $color)
                        <div class="z-depth-2" style="background-color: {{ $color }}; height: 0.4em; width: 0.4em; border-radius: 50%; margin-right: 0.5em; margin-top: 2px"></div>
                    @endforeach
                </div>
                <span class="color-grade-{{ $route->val_grade }} text-bold">{{ $route->grade }}{{ $route->sub_grade }}</span>
                {{ $route->label }}
            </h5>
        </div>
        <div class="col s7 text-right">
            <button onclick="getGymSector({{ $route->sector->id }}, '{{ $route->sector->label }}'); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                <i class="material-icons left">keyboard_arrow_left</i>
            </button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        @if($route->description != '')
            <p class="grey-text">
                <i class="material-icons left" style="font-size: 1.4em">reorder</i>
                {{ $route->description }}
            </p>
        @endif
        @if($route->hasPicture())
            <div>
                <img src="{{ $route->picture(500) }}" class="responsive-img">
            </div>
        @endif
        <p class="text-center grey-text text-italic">
            Ouvert par {{ $route->opener }} le {{ $route->opener_date->format('d/m/Y') }}
        </p>
    </div>
</div>
@if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
    <div class="row">
        <div class="col s12 top-border">
            <p><i class="material-icons left blue-text">settings</i><strong>Administration</strong></p>
        </div>
        <div class="col s12 administration-area">
            <button {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$gym->id]), ["id" => $route->id, "room_id"=>$room->id, "gym_id"=>$gym->id, "sector_id"=>$route->sector_id, "title"=>'Modifier la voie', "method"=>"PUT", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                Modifier la voie
                <i class="material-icons left">edit</i>
            </button>
            <button {!! $Helpers::modal(route('routeUploadSchemeModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=>'Uploader une photo', "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                Uploader une photo
                <i class="material-icons left">photo_camera</i>
            </button>
            <button {!! $Helpers::modal(route('routeUploadThumbnailModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=>'Uploader une miniature', "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                Uploader une miniature
                <i class="material-icons left">crop_original</i>
            </button>
            <button class="btn btn-flat btn" onclick="dismountRoute({{ $route->id }})">
                @if($route->dismounted_at == null)
                    Démonter la voie
                    <i class="material-icons left">reply</i>
                @else
                    Remonter la voie
                    <i class="material-icons left">keyboard_capslock</i>
                @endif
            </button>
            <button class="btn btn-flat btn" onclick="favoriteRoute({{ $route->id }})">
                @if($route->favorite)
                    Ligne favoris
                    <i class="material-icons left red-text">favorite</i>
                @else
                    Mettre en favoris
                    <i class="material-icons left">favorite_border</i>
                @endif
            </button>
        </div>
    </div>
@endif
