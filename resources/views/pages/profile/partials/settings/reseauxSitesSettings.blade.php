<h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/settings.titleSocialNetwork')</h2>

<div id="insert-social-network-zone">
    <table class="bordered">
        <thead>
            <tr>
                <th class="text-center">@lang('pages/profile/settings.columnType')</th>
                <th>@lang('pages/profile/settings.columnName')</th>
                <th class="hide-on-small-only">@lang('pages/profile/settings.columnUrl')</th>
                <th class="text-center">@lang('pages/profile/settings.columnUrl')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->socialNetworks as $network)
                <tr>
                    <td class="text-center"><img title="{{$network->socialNetwork->label}}" src="/img/social-{{$network->socialNetwork->id}}.svg" height="30"></td>
                    <td>{{$network->label}}</td>
                    <td class="hide-on-small-only"><a target="_blank" href="{{$network->url}}">{{$network->url}}</a></td>
                    <td class="text-center i-cursor">
                        <i {!! $Helpers::tooltip(trans('modals/link.editTooltip')) !!} {!! $Helpers::modal(route('socialNetworkModal'), ["social_id"=> $network->id, "title"=>trans('modals/link.modalEditeTitle'), "method"=>"PUT", "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">edit</i>
                        <i {!! $Helpers::tooltip(trans('modals/link.deleteTooltip')) !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/socialNetworks/" . $network->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h2 class="loved-king-font titre-profile-boite-vue titre-ajouter-liens">@lang('pages/profile/settings.titleAddLink')</h2>

<form class="submit-form row" data-route="/socialNetworks" onsubmit="submitData(this, reloadCurrentVue); return false">

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::social(['name'=>'social_network_id', 'value'=>'', 'label'=>trans('pages/profile/settings.labelType')]) !!}
    {!! $Inputs::text(['name'=>'label', 'value'=>'', 'label'=>trans('pages/profile/settings.labelTitle'), 'type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'url', 'value'=>'', 'label'=>trans('pages/profile/settings.labelUrl'), 'type'=>'url']) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>trans('pages/profile/settings.addSubmit'), 'cancelable' => false]) !!}
    </div>

</form>