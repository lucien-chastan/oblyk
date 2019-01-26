@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'required'=>true, 'value'=>$dataModal['gym_room']->label, 'label'=>'Nom de l\'espace', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'order', 'value'=>$dataModal['gym_room']->order, 'label'=>"Ordre d'importance", 'type'=>'number']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym_room']->description, 'label'=>'Description', 'type'=>'text']) !!}
        {!! $Inputs::gymRoutesTypes(['name'=>'preferred_type', 'value'=>$dataModal['gym_room']->preferred_type, 'label'=>'Principalement les lignes sont des : ']) !!}
        {!! $Inputs::gymGradesSystem(['name'=>'gym_grade_id', 'gym_id'=>$dataModal['gym_id'], 'value'=>$dataModal['gym_room']->gym_grade_id, 'label'=>'Système de cotation']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym_room']->id]) !!}
</form>
