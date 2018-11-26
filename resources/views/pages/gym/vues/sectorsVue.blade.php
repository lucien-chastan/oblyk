@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row title-and-return">
    <div class="col s12">
        <p><i class="material-icons left blue-text">filter_none</i><strong>Les secteurs</strong></p>
    </div>
</div>
<div class="row">
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
