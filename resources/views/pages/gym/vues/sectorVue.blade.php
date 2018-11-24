@inject('Helpers','App\Lib\HelpersTemplates')

@if($sector->routes_count > 0)
    <div class="row title-and-return">
        <div class="col s12">
            <div class="col s5">
                <p><i class="material-icons left blue-text">timeline</i><strong>Les lignes</strong></p>
            </div>
            <div class="col s7 text-right">
                <button onclick="getSectors(); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                    Retour
                    <i class="material-icons left">keyboard_arrow_left</i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <table class="highlight td-clickable">
                <tbody>
                    @foreach($sector->routes as $route)
                        <tr onclick="getGymRoute({{ $route->id }}, '{{ $route->label }}'); animationLoadSideNav('r')">
                            <td>
                                @foreach($route->colors() as $color)
                                    <div class="z-depth-2"
                                         style="background-color: {{ $color }}; height: 0.6em; width: 0.6em; border-radius: 50%"></div>
                                @endforeach
                            </td>
                            <td><span class="color-grade-{{ $route->val_grade }}">{{ $route->grade }}</span></td>
                            <td>{{ $route->label }}</td>
                            <td class="grey-text">
                                @if($route->isFavorite())
                                    <i style="font-size: 1em" class="material-icons right red-text">favorite</i>
                                @endif
                                @if($route->hasPicture())
                                    <i style="font-size: 1em" class="material-icons right">photo_camera</i>
                                @endif
                                @if($route->description != '')
                                    <i style="font-size: 1em" class="material-icons right">reorder</i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

<div class="row title-and-return {{ ($sector->routes_count > 0) ? 'top-border' : '' }}">
    <div class="col s12">
        <div class="col {{ ($sector->routes_count == 0) ? 's5' : 's12' }}">
            <p><i class="material-icons left blue-text">info</i><strong>Informations</strong></p>
        </div>
        @if($sector->routes_count == 0)
            <div class="col s7 text-right">
                <button onclick="getSectors(); animationLoadSideNav('l')" class="btn btn-flat waves-effect waves-light" type="submit" name="action">
                    Retour
                    <i class="material-icons left">keyboard_arrow_left</i>
                </button>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div>
        <div class="col {{ ($sector->routes_count == 0) ? 's12' : 's10' }}">
            @markdown($sector->description)
        </div>
        @if($sector->routes_count > 0)
            <div class="col s2 grey-text">
                <p title="hauteur du secteur">{{ $sector->height }}m</p>
            </div>
        @endif
    </div>
    @if($sector->hasPicture())
        <div class="col s12">
            <img src="{{ $sector->picture(500) }}" class="responsive-img smooth-radius-image">
        </div>
    @endif
</div>

<div class="row">
    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <div class="col s12 top-border">
            <p><i class="material-icons left blue-text">settings</i><strong>Administration</strong></p>
        </div>
        <div class="col s12 administration-area">
            <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["id" => $sector->id, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "title"=>'Modifier ce secteur', "method"=>"PUT", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btn btnModal">
                Ajouter une voie
                <i class="material-icons left">add</i>
            </button>
            <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["id" => $sector->id, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "title"=>'Modifier ce secteur', "method"=>"PUT", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btn btnModal">
                Modifier le secteur
                <i class="material-icons left">edit</i>
            </button>
            <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["id" => $sector->id, "room_id"=>$sector->room_id, "gym_id"=>$gym->id, "title"=>'Modifier ce secteur', "method"=>"PUT", 'callback'=>'reloadSectorVue']) !!} class="btn btn-flat btn btnModal">
                Changer la couverture
                <i class="material-icons left">photo_camera</i>
            </button>
            @if( $sector->area == '')
                <button class="btn btn-flat start-edition-btn" onclick="startNewSector({{ $sector->id }})">
                    Créer la zone sur le plan
                    <i class="material-icons left">crop_free</i>
                </button>
            @else
                <button class="btn btn-flat start-edition-btn" onclick="startEditSector({{ $sector->id }})">
                    Editer la zone sur le plan
                    <i class="material-icons left">crop_free</i>
                </button>
            @endif
        </div>
    @endif
</div>