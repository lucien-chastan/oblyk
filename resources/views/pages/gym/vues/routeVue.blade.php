@inject('Helpers','App\Lib\HelpersTemplates')
<div class="row title-and-return">
    <div class="col s12">
        <div class="col s5">
            <h5 class="loved-king-font">
                <div class="left">
                    @foreach($route->holdColors() as $holdColor)
                        <div class="z-depth-2" style="background-color: {{ $holdColor }}; height: 0.4em; width: 0.4em; border-radius: 50%; margin-right: 0.5em; margin-top: 2px"></div>
                    @endforeach
                </div>
                <span class="color-grade-{{ $route->val_grade }} text-bold">{{ $route->grade }}</span>
                {{ $route->label }}
            </h5>
        </div>
        <div class="col s7 text-right">
            <button onclick="getGymSector({{ $route->sector->id }}, '{{ $route->sector->label }}'); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                Retour
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
            <button {!! $Helpers::modal(route('routeUploadSchemeModal', ["gym_id"=>$gym->id, "route_id"=>$route->id]), ["id" => $route->id, "gym_id"=>$gym->id, "title"=>'Uploader une photo', "method"=>"POST", 'callback'=>'reloadRouteVue']) !!} class="btn btn-flat btn btnModal">
                Uploader une photo
                <i class="material-icons left">photo_camera</i>
            </button>
        </div>
    </div>
@endif
