@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym']->label, 'label'=>'Nom de la salle', 'placeholder'=>'Nom du site (exemple : M\'Roc 3)','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'city', 'value'=>$dataModal['gym']->city, 'label'=>'Commune', 'placeholder'=>'Nom de la ville ou de la commune','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'big_city', 'value'=>$dataModal['gym']->big_city, 'label'=>'Grande ville la plus proche (optionnel)', 'placeholder'=>'par exemple pour Montreuil, c\'est Paris','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'address', 'value'=>$dataModal['gym']->address, 'label'=>'Adresse de la salle', 'placeholder'=>'Adresse de la salle','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'postal_code', 'value'=>$dataModal['gym']->postal_code, 'label'=>'Code postal de la salle', 'placeholder'=>'Code postal de la salle','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'region', 'value'=>$dataModal['gym']->region, 'label'=>'Département', 'placeholder'=>'Département de la salle','type'=>'text']) !!}
        {!! $Inputs::checkbox(['name'=>'type_boulder', 'checked'=>($dataModal['gym']->type_boulder == 1), 'label'=>'Cette salle a une partie bloc']) !!}
        {!! $Inputs::checkbox(['name'=>'type_route', 'checked'=>($dataModal['gym']->type_route == 1), 'label'=>'Cette salle a une partie voie']) !!}
        {!! $Inputs::text(['name'=>'phone_number', 'value'=>$dataModal['gym']->phone_number, 'label'=>'Numéro de téléphone', 'placeholder'=>'Numéro de la salle','type'=>'tel']) !!}
        {!! $Inputs::text(['name'=>'email', 'value'=>$dataModal['gym']->email, 'label'=>'Email de la salle', 'placeholder'=>'Email de la salle','type'=>'email']) !!}
        {!! $Inputs::text(['name'=>'web_site', 'value'=>$dataModal['gym']->web_site, 'label'=>'Site internet de la salle', 'placeholder'=>'http://','type'=>'url']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym']->description, 'label'=>'Une description de la salle ? (optionnel)']) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['gym']->lat, 'lng'=>$dataModal['gym']->lng, 'label'=>'Localisation (cliquez sur la carte pour changer la localisation)']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'code_country','value'=>$dataModal['gym']->code_country]) !!}
    {!! $Inputs::Hidden(['name'=>'country','value'=>$dataModal['gym']->country]) !!}
</form>
