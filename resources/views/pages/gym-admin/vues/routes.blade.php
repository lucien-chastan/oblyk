@inject('Helpers','App\Lib\HelpersTemplates')
@php($current_opener_date = null)

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <div class="row">
                <table>
                    <tbody>
                        @foreach($routes as $route)
                            @if($current_opener_date == null || $current_opener_date != $route->opener_date->format('d/m/Y'))
                                @php($current_opener_date = $route->opener_date->format('d/m/Y'))
                                <tr class="tr-open-at" title="{{ $route->opener_date->format('d/m/Y') }}">
                                    <td colspan="6" class="grey-text">{{ $route->opener_date->diffForHumans() }}</td>
                                </tr>
                            @endif
                            <tr class="{{ $route->dismounted_at != null ? 'grey-text' : '' }}">
                                <td>
                                    @if($route->hasThumbnail())
                                        <img src="{{ $route->thumbnail() }}" height="35" class="circle">
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
                                <td>
                                    <a href="{{ $route->sector->room->url() }}">
                                        {{ $route->sector->room->label }}
                                    </a>
                                </td>
                                <td>{{ $route->opener }}</td>
                                <td class="grey-text">
                                    @if($route->hasPicture())
                                        <i style="font-size: 1em" class="material-icons right">photo_camera</i>
                                    @endif
                                    @if($route->description != '')
                                        <i style="font-size: 1em" class="material-icons right">reorder</i>
                                    @endif
                                </td>
                                <td>
                                    <span title="Favoris : oui/non">
                                        @if($route->isFavorite())
                                            <i style="font-size: 1em" class="material-icons right {{ $route->dismounted_at == null ? 'red-text' : '' }}">favorite</i>
                                        @else
                                            <i style="font-size: 1em" class="material-icons right">favorite_border</i>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span title="Démonter ou remonter la ligne" onclick="dismountRoute({{ $route->id }})">
                                        @if($route->dismounted_at == null)
                                            <i style="font-size: 1em" class="material-icons right">keyboard_capslock</i>
                                        @else
                                            <i style="font-size: 1em" class="material-icons right">keyboard_arrow_down</i>
                                        @endif
                                    </span>
                                </td>
                                <td class="grey-text">
                                    <span {!! $Helpers::tooltip('Modifier la voie') !!} {!! $Helpers::modal(route('gymRouteModal', ["gym_id"=>$route->sector->room->gym_id]), ["id" => $route->id, "room_id"=>$route->sector->room->id, "gym_id"=>$route->sector->room->gym_id, "sector_id"=>$route->sector_id, "title"=>'Modifier la voie', "method"=>"PUT", 'callback'=>'reloadCurrentVue']) !!} class="tooltipped btnModal">
                                        <i style="font-size: 1em" class="material-icons right">edit</i>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
