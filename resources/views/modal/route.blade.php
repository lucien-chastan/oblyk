@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['ligne']->label, 'label'=>'Nom de la ligne', 'placeholder'=>'Nom de la ligne (exemple : Biographie)','type'=>'text']) !!}
        {!! $Inputs::sectors(['name'=>'sector_id', 'value'=>$dataModal['ligne']->sector_id, 'label'=>'Secteur', 'crag_id'=>1]) !!}
        {!! $Inputs::climbs(['name'=>'climb_id', 'value'=>$dataModal['ligne']->climb_id, 'label'=>'Type de grimpe']) !!}
        {!! $Inputs::text(['name'=>'height', 'value'=>$dataModal['ligne']->height, 'label'=>'Hauteur', 'placeholder'=>'Hauteur en mètre','type'=>'number']) !!}
        {!! $Inputs::grades(['grade'=>'2a', 'sub_grade'=>'+']) !!}
        {!! $Inputs::text(['name'=>'open_year', 'value'=>$dataModal['ligne']->open_year, 'label'=>'Année d\'ouverture', 'placeholder'=>'Année de l\'ouverture de la ligne','type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'opener', 'value'=>$dataModal['ligne']->opener, 'label'=>'Nom des ouvreurs', 'placeholder'=>'Nom des ouvreurs de la ligne','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['ligne']->id]) !!}
</form>
