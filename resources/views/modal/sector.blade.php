@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['sector']->label, 'label'=>'Nom du secteur', 'placeholder'=>'Nom du secteur (exemple : Face Nord)','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'approach','value'=>$dataModal['sector']->approach, 'label'=>'Temps d\'approche (en minute)', 'placeholder'=>'temps de marche jusqu\'au secteur', 'type'=>'number']) !!}
        {!! $Inputs::suns(['name'=>'sun_id','value'=>$dataModal['sector']->sun_id, 'label'=>'Ensoleillement du secteur']) !!}
        {!! $Inputs::rains(['name'=>'rain_id','value'=>$dataModal['sector']->rain_id, 'label'=>'Éxposition à la pluie']) !!}
        {!! $Inputs::orientations(['value'=>$dataModal['sector']->orientation, 'orientable_type'=>'App\Sector', 'orientable_id'=>$dataModal['sector']->id, 'label'=>'Orientations du secteur', 'col'=>6]) !!}
        {!! $Inputs::saisons(['value'=>$dataModal['sector']->season, 'seasontable_type'=>'App\Sector', 'seasontable_id'=>$dataModal['sector']->id, 'label'=>'Saisons favorables', 'col'=>6]) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['sector']->lat, 'lng'=>$dataModal['sector']->lng, 'label'=>'Localisation (cliquez sur la carte pour changer la localisation)']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['sector']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['sector']->crag_id]) !!}
</form>
