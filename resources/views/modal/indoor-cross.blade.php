@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$title]) !!}

<form class="submit-form" data-route="{{ $route }}" onsubmit="submitData(this, {{ $callback }}); return false">

    {!! $Inputs::popupError() !!}

    @if($show_alert)
        <div class="yellow lighten-4 cross-alert">
            <p>
                Si les lignes sont renseignées, préférez mettre vos croix dessus, vous aurez moins d'informations à
                renseigner
            </p>
        </div>
    @endif

    <div class="row">

        @if($show_pitches)
            {!! $Inputs::pitchesVariant(['name'=>'pitch','pitches'=>$pitches, 'label'=>'Quelle variante avez-vous fait', 'value'=> 0, 'col' => 's12']) !!}
        @endif

        {!! $Inputs::crossStatuses(['name'=>'status_id','label'=>trans('modals/cross.status'), 'value'=> $cross->status_id, 'col' => ($hide_mode ? 's12' : 's6')]) !!}
        {!! $Inputs::crossModes(['name'=>'mode_id','label'=>trans('modals/cross.mode'), 'value'=> $cross->mode_id, 'col' => 's6', 'class' => ($hide_mode ? 'hide' : '')]) !!}
        {!! $Inputs::date(['name'=>'release_at', 'label'=>trans('modals/cross.crossDate'), 'placeholder'=>trans('modals/cross.crossDate'), 'value'=> $cross->release_at->format('Y-m-d')]) !!}

        @if($show_grade_system && $gym_grade_id !== null)
            {!! $Inputs::gymLevelGrade(['name'=>'gradeLine', 'gym_grade_id'=>$gym_grade_id, 'label'=>'Niveau', 'value'=>'', 'placeholder'=>"Niveau de cotation", "onChange" => "getDefaultRouteGrade(this)"]) !!}
        @endif

        {!! $Inputs::grade(['name'=>'grade', 'id' => 'gymRouteGradeText', 'label'=>'Cotation', 'value'=>$cross->grade . $cross->sub_grade, 'placeholder'=>"cotation, exemple 6a+, 5c, 7b/+, etc.", 'col' => ($hide_type ? 's12' : 's6'), 'class' => $hide_grade ? 'hide' : '' ]) !!}
        {!! $Inputs::gymRoutesTypes(['name'=>'type', 'value'=>$cross->type, 'label'=>'Type de la ligne', 'col' => ($hide_grade ? 's12' : 's6'), 'class' => $hide_type ? 'hide' : '' ]) !!}

        {!! $Inputs::text(['name'=>'height', 'required'=>true, 'value'=>$cross->height, 'label'=>'Hauteur (en mètre)', 'type'=>'text', 'class' => $hide_height ? 'hide' : '' ]) !!}

        {!! $Inputs::mdText(['name'=>'description', 'value'=>$cross->description, 'label'=>'Description', 'type'=>'text']) !!}

        <div class="row {{ $hide_color ? 'hide' : '' }}">
            <div class="col s12">
                <div class="col s6">
                    <p class="text-underline">Couleur des prises</p>
                    {!! $Inputs::colorList(['name'=>'color_first', 'id'=>'firstColorGymRoute', 'label'=>'Première couleur', 'value'=>$colors[0] ?? '#f2f2f2', 'placeholder'=>"Première couleur"]) !!}
                </div>
                <div class="col s6">
                    <p class="text-underline">
                        {!! $Inputs::checkbox(['name'=>'use_second_color', 'id'=>'useSecondColorGymRoute', 'checked'=>($use_second_color == 1), 'label' => 'Prise bi-color']) !!}
                    </p>
                    {!! $Inputs::colorList(['name'=>'color_second', 'id'=>'secondColorGymRoute', 'label'=>'Second couleur', 'value'=>$colors[1] ?? '#f2f2f2', 'placeholder'=>"Seconde couleur"]) !!}
                </div>
            </div>
        </div>
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}

    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$method]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$id]) !!}
    {!! $Inputs::Hidden(['name'=>'sector_id','value'=>$sector_id]) !!}
    {!! $Inputs::Hidden(['name'=>'route_id','value'=>$route_id]) !!}
    {!! $Inputs::Hidden(['name'=>'room_id','value'=>$room_id]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$gym_id]) !!}
    {!! $Inputs::Hidden(['name'=>'environment','value'=>0]) !!}
</form>
