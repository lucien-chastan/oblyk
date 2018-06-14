@inject('Helpers','App\Lib\HelpersTemplates')

<div class="row">
    <div class="col s12">
        <div class="card-panel blue-card-panel">
            <table class="striped">
                <tbody>
                @foreach($administrators as $administrator )
                    <tr>
                        <td width="10"><img class="circle" height="30" src="{{ $administrator->user->picture(50) }}"></td>
                        <td>
                            <a target="_blank" href="{{ route('userPage', ['user_name' => str_slug($administrator->user->name), 'user_id' => $administrator->user->id]) }}">
                                {{ $administrator->user->name }}
                            </a>
                        </td>
                        <td><i {!! $Helpers::tooltip(trans('modals/description.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route" => "/gym_administrators/" . $administrator->id]) !!} class="material-icons tooltipped right grey-text btnModal">delete</i></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-right">
                <button {!! $Helpers::modal(route('gymAddAdministratorModal', ["gym_id"=>$gym->id,]), ["gym_id"=>$gym->id]) !!} class="btn-flat btnModal">
                    <i class="material-icons left">add</i>
                    Ajouter un menbre
                </button>
            </div>
        </div>
    </div>
</div>
