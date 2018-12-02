<form id="form-password-setting" class="submit-form row" data-route="{{route('saveMailPassword')}}" onsubmit="submitData(this, majSettingsEmail); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/settings.titleEmailConnexion')</h2>

    {!! $Inputs::popupError() !!}

    {!! $Inputs::text(['name'=>'email', 'value'=>$user->email, 'label'=>trans('pages/profile/settings.labelMyEmail'), 'type'=>'email']) !!}
    {!! $Inputs::checkbox(['name'=>'change_mpd', 'label'=>trans('pages/profile/settings.labelChangeMyPassword'), 'checked' => false, 'align' => 'left', 'onchange'=>'showChangeMdp()']) !!}

    <div id="zone-change-mdp" style="display: none">
        {!! $Inputs::text(['name'=>'password_old', 'value'=>'', 'label'=>trans('pages/profile/settings.labelOldPassword'), 'type'=>'password']) !!}
        {!! $Inputs::text(['name'=>'password_new', 'value'=>'', 'label'=>trans('pages/profile/settings.labelNewPassword'), 'type'=>'password']) !!}
        {!! $Inputs::text(['name'=>'password_confirm', 'value'=>'', 'label'=>trans('pages/profile/settings.labelConfirmNewPassword'), 'type'=>'password']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>trans('pages/profile/settings.saveSubmit'), 'cancelable' => false]) !!}
    </div>

</form>
