@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row title-and-return">
    <div class="col s12">
        <ul class="tabs sectors-and-routes-tabs">
            <li class="tab col s6">
                <a class="active" href="#sectors-tab">
                    <i class="material-icons blue-text">filter_none</i>
                    Secteurs
                </a>
            </li>
            <li class="tab col s6">
                <a href="#routes-tab">
                    <i class="material-icons blue-text">show_chart</i>
                    Ouvertures
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="row" id="sectors-tab">
    <div class="col s12">
        @if (count($sectors) > 0)
            <table class="highlight td-clickable">
                <tbody>
                    @foreach($sectors as $sector)
                        <tr onclick="getGymSector({{ $sector->id }}, '{{ $sector->label }}'); animationLoadSideNav()">
                            <td><strong>{{ $sector->label }}</strong></td>
                            <td>
                                @if($sector->routes_count > 0)
                                    <span {!! $Helpers::tooltip('Nombre de ligne') !!} class="badge tooltipped">{{ $sector->routes_count }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-italic grey-text text-center">Les secteurs non pas encore été créés</p>
        @endif
    </div>

    @if(Auth::check() && $gym->userIsAdministrator(Auth::id()))
        <div class="row">
            <div class="col s12 top-border">
                <p><i class="material-icons left blue-text">settings</i><strong>Administration</strong></p>
            </div>
            <div class="col s12 administration-area">
                <button {!! $Helpers::modal(route('gymSectorModal', ["gym_id"=>$gym->id,]), ["room_id"=>$room->id, "gym_id"=>$gym->id, "title"=>'Créer un secteur', "method"=>"POST", 'callback'=>'reloadSectorsVue']) !!} class="btn btn-flat btn btnModal">
                    Ajouter un secteur
                    <i class="material-icons left">add</i>
                </button>
            </div>
        </div>
    @endif

</div>

<div class="row" id="routes-tab">
    <table class="highlight td-clickable">
        @php($current_opener_date = null)
        @foreach($routes as $route)
            @if($current_opener_date == null || $current_opener_date != $route->opener_date->format('d/m/Y'))
                @php($current_opener_date = $route->opener_date->format('d/m/Y'))
                <tr class="tr-open-at" title="{{ $route->opener_date->format('d/m/Y') }}">
                    <td colspan="6" class="grey-text">{{ $route->opener_date->diffForHumans() }}</td>
                </tr>
            @endif
            <tr onclick="getGymRoute({{ $route->id }}, '{{ $route->label }}'); animationLoadSideNav('r')">
                <td>
                    @if($route->hasThumbnail())
                        <img src="{{ $route->thumbnail() }}" class="circle left" height="35">
                    @endif
                </td>
                <td>
                    @foreach($route->colors() as $color)
                        <div class="z-depth-2" style="background-color: {{ $color }}; height: 0.6em; width: 0.6em; border-radius: 50%"></div>
                    @endforeach
                </td>
                <td><span class="color-grade-{{ $route->val_grade }}">{{ $route->grade }}{{ $route->sub_grade }}</span></td>
                <td>{{ $route->label }}</td>
                <td>{{ $route->sector->label }}</td>
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
    </table>
</div>