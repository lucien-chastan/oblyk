
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

{{--UPLOAD DES PHOTOS DE PROFIL ET BANDEAU--}}
<h2 class="loved-king-font titre-profile-boite-vue">Photo de profil &amp; Bandeau</h2>

<form id="form-upload-photo-profil-setting" class="submit-form row" onsubmit="return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        <div class="upload-settings-col-image">
            <img src="{{$user->image}}?cache={{date('Ymdhis')}}" alt="" class="circle left img-settings">
        </div>
        <div class="upload-settings-col-input">
            {!! $Inputs::upload(['name'=>'image', 'filter'=>'image/*', 'id'=>'upload-photo-profil' ,'label'=>'Photo de profil', 'onchange'=>'uploadImageProfile()']) !!}
            {!! $Inputs::progressbar(['id'=>'progressbar-upload-photo-profil']) !!}
        </div>
    </div>

</form>

<form id="form-upload-photo-bandeau-setting" class="submit-form row" onsubmit="return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        <div class="upload-settings-col-image">
            <div class="left img-settings grey darken-1" style="background-image: url('{{$user->bandeau}}')">

            </div>
        </div>
        <div class="upload-settings-col-input">
            {!! $Inputs::upload(['name'=>'bandeau', 'filter'=>'image/*', 'id'=>'upload-photo-bandeau' ,'label'=>'Bandeau', 'onchange'=>'uploadBandeau()']) !!}
            {!! $Inputs::progressbar(['id'=>'progressbar-upload-photo-bandeau']) !!}
        </div>
    </div>

</form>

{{--SUPPRIMER SON COMPTE--}}
<form class="submit-form row" data-route="" onsubmit="submitData(this, majSettingsDashboard); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Supprimer mon compte</h2>

</form>