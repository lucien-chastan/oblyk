<form id="form-password-setting" class="submit-form row" data-route="{{route('saveMailPassword')}}" onsubmit="submitData(this, majSettingsEmail); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Mot de passe &amp; Email de connexion</h2>

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::text(['name'=>'email', 'value'=>$user->email, 'label'=>'Mon email', 'type'=>'email']) !!}
    {!! $Inputs::checkbox(['name'=>'change_mpd', 'label'=>'Changer mon mot de passe', 'checked' => false, 'align' => 'left', 'onchange'=>'showChangeMdp()']) !!}

    <div id="zone-change-mdp" style="display: none">
        {!! $Inputs::text(['name'=>'password_old', 'value'=>'', 'label'=>'Mon ancien mot de passe', 'type'=>'password']) !!}
        {!! $Inputs::text(['name'=>'password_new', 'value'=>'', 'label'=>'Mon nouveau mot de passe', 'type'=>'password']) !!}
        {!! $Inputs::text(['name'=>'password_confirm', 'value'=>'', 'label'=>'Confirmer mon nouveau mot de passe', 'type'=>'password']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
    </div>

</form>
