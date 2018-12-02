@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym_grade_line']->label, 'label'=>'Nom de la cotation (exemple : assez facile, dur, etc.)', 'type'=>'text']) !!}
        <div class="row">
            {!! $Inputs::gymGrade(['name'=>'grade_val', 'label'=>'Cotation représentative', 'value'=>$dataModal['gym_grade_line']->grade_val, 'placeholder'=>"Cotation"]) !!}
        </div>
        {!! $Inputs::text(['name'=>'order', 'value'=>$dataModal['gym_grade_line']->order, 'label'=>'Ordre', 'type'=>'number']) !!}
        <div class="row">
            <div class="col s12">
                <div class="col s6">
                    <p class="text-underline">Couleur</p>
                    {!! $Inputs::color(['name'=>'color_first', 'label'=>'Première couleur', 'value'=>$dataModal['colors'][0] ?? '#ffffff', 'placeholder'=>"Première couleur"]) !!}
                </div>
                <div class="col s6">
                    <p class="text-underline">
                        {!! $Inputs::checkbox(['name'=>'use_second_color', 'checked'=>($dataModal['use_second_color'] == 1), 'label' => 'Utiliser une seconde couleur']) !!}
                    </p>
                    {!! $Inputs::color(['name'=>'color_second', 'label'=>'Second couleur', 'value'=>$dataModal['colors'][1] ?? '#ffffff', 'placeholder'=>"Seconde couleur"]) !!}
                </div>
            </div>
        </div>
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_grade_id','value'=>$dataModal['gym_grade_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
</form>
