@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>'Nom du lieu', 'type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Informations complémentaires (optionnel)', 'placeholder'=>'ici tu peux donner plus d\'informations vis-à-vis de ce lieux (horaire de passage, secteur, etc.)']) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['lat'], 'lng'=>$dataModal['lng'], 'label'=>'Localisation (cliquez sur la carte pour localiser le lieux)', 'withRayon'=>true, "rayon"=>$dataModal['rayon']]) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
</form>
