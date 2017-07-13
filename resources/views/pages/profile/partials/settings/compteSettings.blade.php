
{{--INFORMATIONS GÉNÉRALES--}}
<form id="form-compte-setting" class="submit-form row" data-route="/users/{{$user->id}}" onsubmit="submitData(this, majSettingsCompte); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Mes informations</h2>

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::text(['name'=>'name', 'value'=>$user->name, 'label'=>'Mon nom', 'type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'localisation', 'value'=>$user->localisation, 'label'=>'La où je grimpe', 'type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'birth', 'value'=>$user->birth, 'label'=>'Année de naissance', 'type'=>'number']) !!}
    {!! $Inputs::sex(['name'=>'sex', 'value'=>$user->sex, 'label'=>'Je suis']) !!}
    {!! $Inputs::mdText(['name'=>'description', 'value'=>$user->description, 'label'=>'Qui je suis en quelques mots']) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'PUT']) !!}

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
    </div>

</form>


{{--SUPPRIMER SON COMPTE--}}
<form class="submit-form row" data-route="" onsubmit="submitData(this, majSettingsDashboard); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Supprimer mon compte</h2>

</form>