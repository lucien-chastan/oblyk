@inject('Helpers','App\Lib\HelpersTemplates')
@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <button class="btn-flat right waves-effect blue-text" onclick="loadProfileRoute(document.getElementById('item-qui-je-suis-nav'))"><i class="material-icons left">arrow_back</i>Qui je suis ?</button>

            <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/myPlaces.titlePlaces')</h2>

            @if($user->partnerSettings->partner == 0)
                <div class="red lighten-4 alert-partenaire-div">
                    <p class="text-center">
                        @lang('pages/profile/myPlaces.alert')<br>
                    </p>
                    <p class="text-center">
                        <a onclick="activePartner()" class="btn-flat waves-effect text-bold"><i class="material-icons left">person_pin</i> @lang('pages/profile/myPlaces.actionAlert')</a>
                    </p>
                </div>
            @endif

            <p>
                @lang('pages/profile/myPlaces.explication')
            </p>

            @if(count($user->places) > 0)
                <table>
                    <thead>
                    <tr>
                        <th class="text-center">@lang('pages/profile/myPlaces.activeColumn')</th>
                        <th class="text-center">@lang('pages/profile/myPlaces.placeNameColumn')</th>
                        <th class="text-center">@lang('pages/profile/myPlaces.descriptionColumn')</th>
                        <th class="text-center">@lang('pages/profile/myPlaces.rayonColumn')</th>
                        <th class="text-center">@lang('pages/profile/myPlaces.actionColumn')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->places as $place)
                        <tr>
                            <td class="no-warp">
                                <div class="switch">
                                    <label>
                                        @lang('pages/profile/myPlaces.swtichNo')
                                        @if($place->active == 1)
                                            <input value="{{ $place->id }}" onchange="activeLieu(this)" type="checkbox" checked>
                                        @else
                                            <input value="{{ $place->id }}" onchange="activeLieu(this)" type="checkbox">
                                        @endif
                                        <span class="lever"></span>
                                        @lang('pages/profile/myPlaces.swtichYes')
                                    </label>
                                </div>
                            </td>
                            <td>{{ $place->label }}</td>
                            <td>{{ $place->description }}</td>
                            <td class="text-center grey-text no-warp">{{ $place->rayon }} Km</td>
                            <td class="text-center grey-text i-cursor no-warp">
                                <i {!! $Helpers::modal(route('partnerModal'), ["place_id"=>$place->id, "title"=>trans('modals/parking.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadCurrentVue" ]) !!} {!! $Helpers::tooltip(trans('modals/parking.editTooltip')) !!} class="material-icons blue-hover tooltipped btnModal">edit_location</i>
                                <i {!! $Helpers::modal(route('deleteModal'), ["route"=>"/partners/" . $place->id, "callback"=>"reloadCurrentVue" ]) !!} {!! $Helpers::tooltip(trans('modals/partner.deleteTooltip')) !!} class="material-icons blue-hover tooltipped btnModal">delete</i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                <p class="text-right">
                    <a {!! $Helpers::modal(route('partnerModal'), ["place_id"=>"", "title"=>trans('modals/partner.addTooltip'), "method"=>"POST", "callback"=>"reloadCurrentVue" ]) !!} class="btn waves-effect btnModal"><i class="material-icons left">add_location</i> @lang('modals/partner.addTooltip')</a>
                </p>

            @else
                <p class="text-center">
                    <a {!! $Helpers::modal(route('partnerModal'), ["place_id"=>"", "title"=>trans('modals/partner.addTooltip'), "method"=>"POST", "callback"=>"reloadCurrentVue" ]) !!} class="btn waves-effect btnModal"><i class="material-icons left">add_location</i> @lang('pages/profile/myPlaces.firstNewPlace')</a>
                </p>
            @endif

        </div>
    </div>
</div>


<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">

            <a href="{{ route('partnerMapPage') }}" class="btn-flat right waves-effect blue-text"><i class="material-icons left">map</i>La carte des grimpeurs</a>

            <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/myPlaces.titlePlaceMap')</h2>
            @if(count($user->places) > 0)
                <div id="placeSettingMap" class="placeSettingMap"></div>
            @else
                <p class="text-center grey-text">
                    @lang('pages/profile/myPlaces.paraNoPlace')
                </p>
            @endif
        </div>
    </div>
</div>