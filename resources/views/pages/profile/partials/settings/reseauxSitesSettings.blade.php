<h2 class="loved-king-font titre-profile-boite-vue">Liens vers mes réseaux sociaux &amp; sites internets</h2>

<div id="insert-social-network-zone">
    <table class="bordered">
        <thead>
            <tr>
                <th class="text-center">type</th>
                <th>nom</th>
                <th>url</th>
                <th class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->socialNetworks as $network)
                <tr>
                    <td class="text-center"><img title="{{$network->socialNetwork->label}}" src="/img/social-{{$network->socialNetwork->id}}.svg" height="30"></td>
                    <td>{{$network->label}}</td>
                    <td><a target="_blank" href="{{$network->url}}">{{$network->url}}</a></td>
                    <td class="text-center i-cursor">
                        <i {!! $Helpers::tooltip('Modifier ce lien') !!} {!! $Helpers::modal(route('socialNetworkModal'), ["social_id"=> $network->id, "title"=>"Modifier ce lien", "method"=>"PUT", "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">edit</i>
                        <i {!! $Helpers::tooltip('Supprimer ce lien') !!} {!! $Helpers::modal(route('deleteModal'), ["route"=>"/socialNetworks/" . $network->id, "callback"=>"reloadCurrentVue" ]) !!} class="material-icons tooltipped btnModal">delete</i>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h2 class="loved-king-font titre-profile-boite-vue titre-ajouter-liens">Ajouter un liens</h2>

<form class="submit-form row" data-route="/socialNetworks" onsubmit="submitData(this, reloadCurrentVue); return false">

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::social(['name'=>'social_network_id', 'value'=>'', 'label'=>'Type de lien']) !!}
    {!! $Inputs::text(['name'=>'label', 'value'=>'', 'label'=>'Titre du lien (optionnel)', 'type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'url', 'value'=>'', 'label'=>'Url du lien', 'type'=>'url']) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Ajouter', 'cancelable' => false]) !!}
    </div>

</form>