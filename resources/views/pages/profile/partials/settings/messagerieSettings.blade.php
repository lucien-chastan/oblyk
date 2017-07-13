
<form id="form-messagerie-setting" class="submit-form row" data-route="{{route('saveUserMessagerieSettings')}}" onsubmit="submitData(this, majSettingsMessagerie); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Paramètres de ma messagerie</h2>

    {!! $Inputs::popupError([]) !!}

    <p>M'envoyer un mail quand :</p>

    {!! $Inputs::checkbox(['name'=>'mail_new_conversation', 'label'=>'J\'ai une nouvelle conversation', 'checked' => ($user->settings->mail_new_conversation == 1) ? true : false, 'align' => 'left']) !!}
    {!! $Inputs::checkbox(['name'=>'mail_new_message', 'label'=>'J\'ai un nouveau message', 'checked' => ($user->settings->mail_new_message == 1) ? true : false, 'align' => 'left']) !!}

    <p>Émettre un signal sonore quand :</p>
    {!! $Inputs::checkbox(['name'=>'sound_alert', 'label'=>'J\'ai un nouveau message', 'checked' => ($user->settings->sound_alert == 1) ? true : false, 'align' => 'left']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

</form>