@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym_grade']->label, 'label'=>'Nom du système de cotation', 'type'=>'text']) !!}
        {!! $Inputs::checkbox(['name'=>'difficulty_is_given_by_labels', 'label'=>'La difficulté est donnée par des étiquettes', 'checked' => ($dataModal['gym_grade']->difficulty_is_given_by_labels == 1)]) !!}
        {!! $Inputs::checkbox(['name'=>'hold_and_label_have_same_color', 'label'=>'Les prises et les étiquettes sont de la même couleur', 'checked' => ($dataModal['gym_grade']->hold_and_label_have_same_color == 1)]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
</form>
