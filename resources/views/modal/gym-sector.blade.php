@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym_sector']->label, 'label'=>'Nom du secteur', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'ref', 'value'=>$dataModal['gym_sector']->ref, 'label'=>'Référence du secteur', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'height', 'value'=>$dataModal['gym_sector']->height, 'label'=>'Hauteur (en mètre)', 'type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym_sector']->description, 'label'=>'Description', 'type'=>'text']) !!}
        <p class="text-underline">Réglage par défaut (au niveau de la salle)</p>
        {!! $Inputs::gymGradesSystem(['name'=>'gym_grade_id', 'gym_id'=>$dataModal['gym_id'], 'value'=>$dataModal['gym_sector']->gym_grade_id, 'label'=>'Système de cotation']) !!}
        {!! $Inputs::gymRoutesTypes(['name'=>'preferred_type', 'value'=>$dataModal['gym_sector']->preferred_type, 'label'=>'Les lignes sont principalement des : ']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'room_id','value'=>$dataModal['room_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym_sector']->id]) !!}
</form>
