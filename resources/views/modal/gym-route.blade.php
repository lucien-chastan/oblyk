@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym_route']->label, 'label'=>'Nom de la voie', 'type'=>'text', 'col' => 's8']) !!}
        {!! $Inputs::text(['name'=>'reference', 'value'=>$dataModal['gym_route']->reference, 'label'=>'Référence de la ligne', 'type'=>'text', 'col' => 's4']) !!}
    </div>
    <div class="row">
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym_route']->description, 'label'=>'Description', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'height', 'value'=>$dataModal['gym_route']->height, 'label'=>'Hauteur (en mètre)', 'type'=>'text']) !!}
        {!! $Inputs::roomSectors(['name'=>'sector_id', 'value'=>$dataModal['gym_route']->sector_id, 'label'=>'Secteur', 'room_id'=>$dataModal['room_id']]) !!}
        {!! $Inputs::gymRoutesTypes(['name'=>'type', 'value'=>$dataModal['gym_route']->type, 'label'=>'Type de la ligne']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'sector_id','value'=>$dataModal['sector_id']]) !!}
</form>
