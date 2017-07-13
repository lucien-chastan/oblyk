
<form id="form-confidentialite-setting" class="submit-form row" data-route="{{route('saveUserConfidentialiteSettings')}}" onsubmit="submitData(this, majSettingsConfidentialite); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Options de confidentialité</h2>

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::checkbox(['name'=>'public', 'label'=>'Mon profil est public', 'checked' => ($user->settings->public == 1) ? true : false, 'align' => 'left']) !!}

    <p>
        <strong class="text-underline">Profil public :</strong><br>
        Ma page à propos, mes photos, vidéo et carnet de croix sont visible par la communauté. (mais reste invisible pour les non-inscrits)
    </p>

    <p>
        <strong class="text-underline">Profil privé :</strong><br>
        Ma page à propos, mes photos, vidéos et carnet de croix sont visible uniquement par mes amis.
    </p>

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

</form>