@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['crag']->label, 'label'=>'Nom du site', 'placeholder'=>'Nom du site (exemple : Omblèze)','type'=>'text']) !!}
        {!! $Inputs::rocks(['name'=>'rock_id', 'value'=>$dataModal['crag']->rock_id, 'label'=>'Type de roche']) !!}
        {!! $Inputs::text(['name'=>'city', 'value'=>$dataModal['crag']->city, 'label'=>'Commune', 'placeholder'=>'Nom de la ville ou de la commune','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'region', 'value'=>$dataModal['crag']->region, 'label'=>'Département', 'placeholder'=>'Département du site','type'=>'text']) !!}
        {!! $Inputs::orientations(['value'=>$dataModal['crag']->orientation, 'orientable_type'=>'App\Crag', 'orientable_id'=>$dataModal['crag']->id, 'label'=>'Orientations du site', 'col'=>6]) !!}
        {!! $Inputs::saisons(['value'=>$dataModal['crag']->season, 'seasontable_type'=>'App\Crag', 'seasontable_id'=>$dataModal['crag']->id, 'label'=>'Saisons favorables', 'col'=>6]) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['crag']->lat, 'lng'=>$dataModal['crag']->lng, 'label'=>'Localisation (cliquez sur la carte pour changer la localisation)']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['crag']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'code_country','value'=>$dataModal['crag']->code_country]) !!}
    {!! $Inputs::Hidden(['name'=>'country','value'=>$dataModal['crag']->country]) !!}
</form>
