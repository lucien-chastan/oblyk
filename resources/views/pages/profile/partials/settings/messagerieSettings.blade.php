<form id="form-messagerie-setting" class="submit-form row" data-route="{{route('saveUserMessagerieSettings')}}" onsubmit="submitData(this, majSettingsMessagerie); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">@lang('pages/profile/settings.titleMessenger')</h2>

    {!! $Inputs::popupError() !!}

    <p>@lang('pages/profile/settings.subTitleMailWhen')</p>

    {!! $Inputs::checkbox(['name'=>'mail_new_conversation', 'label'=>trans('pages/profile/settings.labelNewConversation'), 'checked' => ($user->settings->mail_new_conversation == 1) ? true : false, 'align' => 'left']) !!}
    {!! $Inputs::checkbox(['name'=>'mail_new_message', 'label'=>trans('pages/profile/settings.labelNewMessage'), 'checked' => ($user->settings->mail_new_message == 1) ? true : false, 'align' => 'left']) !!}

    <p>@lang('pages/profile/settings.subTitleSoundWhen')</p>
    {!! $Inputs::checkbox(['name'=>'sound_alert', 'label'=>trans('pages/profile/settings.labelNewMessage'), 'checked' => ($user->settings->sound_alert == 1) ? true : false, 'align' => 'left']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>trans('pages/profile/settings.saveSubmit'), 'cancelable' => false]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

</form>