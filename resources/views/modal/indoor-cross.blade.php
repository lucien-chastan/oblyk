@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    @if($dataModal['show_alert'])
        <div class="yellow lighten-4 cross-alert">
            <p>
                Si les lignes sont renseignées, préférez mettre vos croix dessus, vous aurez moins d'informations à renseigner
            </p>
        </div>
    @endif

    <div class="row">

        @if($dataModal['show_pitches'])
            {!! $Inputs::pitchesVariant(['name'=>'pitch','pitches'=>$dataModal['pitches'], 'label'=>'Quelle variante avez-vous fait', 'value'=> 0, 'col' => 's12']) !!}
        @endif

        {!! $Inputs::crossStatuses(['name'=>'status_id','label'=>trans('modals/cross.status'), 'value'=> $dataModal['cross']->status_id, 'col' => ($dataModal['hide_mode'] ? 's12' : 's6')]) !!}
        {!! $Inputs::crossModes(['name'=>'mode_id','label'=>trans('modals/cross.mode'), 'value'=> $dataModal['cross']->mode_id, 'col' => 's6', 'class' => ($dataModal['hide_mode'] ? 'hide' : '')]) !!}
        {!! $Inputs::date(['name'=>'release_at', 'label'=>trans('modals/cross.crossDate'), 'placeholder'=>trans('modals/cross.crossDate'), 'value'=> $dataModal['cross']->release_at->format('Y-m-d')]) !!}

        @if($dataModal['show_grade_system'] && $dataModal['gym_grade_id'] !== null)
            {!! $Inputs::gymLevelGrade(['name'=>'gradeLine', 'gym_grade_id'=>$dataModal['gym_grade_id'], 'label'=>'Niveau', 'value'=>'', 'placeholder'=>"Niveau de cotation", "onChange" => "getDefaultRouteGrade(this)"]) !!}
        @endif

        {!! $Inputs::grade(['name'=>'grade', 'id' => 'gymRouteGradeText', 'required'=>true, 'label'=>'Cotation', 'value'=>$dataModal['cross']->grade . $dataModal['cross']->sub_grade, 'placeholder'=>"cotation, exemple 6a+, 5c, 7b/+, etc.", 'col' => ($dataModal['hide_type'] ? 's12' : 's6'), 'class' => $dataModal['hide_grade'] ? 'hide' : '' ]) !!}
        {!! $Inputs::gymRoutesTypes(['name'=>'type', 'value'=>$dataModal['cross']->type, 'label'=>'Type de la ligne', 'col' => ($dataModal['hide_grade'] ? 's12' : 's6'), 'class' => $dataModal['hide_type'] ? 'hide' : '' ]) !!}

        {!! $Inputs::text(['name'=>'height', 'required'=>true, 'value'=>$dataModal['cross']->height, 'label'=>'Hauteur (en mètre)', 'type'=>'text', 'class' => $dataModal['hide_height'] ? 'hide' : '' ]) !!}

        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['cross']->description, 'label'=>'Description', 'type'=>'text']) !!}
        <div class="row {{ $dataModal['hide_color'] ? 'hide' : '' }}">
            <div class="col s12">
                <div class="col s6">
                    <p class="text-underline">Couleur</p>
                    {!! $Inputs::colorList(['name'=>'color_first', 'id'=>'firstColorGymRoute', 'label'=>'Première couleur', 'value'=>$dataModal['colors'][0] ?? '#f2f2f2', 'placeholder'=>"Première couleur"]) !!}
                </div>
                <div class="col s6">
                    <p class="text-underline">
                        {!! $Inputs::checkbox(['name'=>'use_second_color', 'id'=>'useSecondColorGymRoute', 'checked'=>($dataModal['use_second_color'] == 1), 'label' => 'Utiliser une seconde couleur']) !!}
                    </p>
                    {!! $Inputs::colorList(['name'=>'color_second', 'id'=>'secondColorGymRoute', 'label'=>'Second couleur', 'value'=>$dataModal['colors'][1] ?? '#f2f2f2', 'placeholder'=>"Seconde couleur"]) !!}
                </div>
            </div>
        </div>
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}

    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'sector_id','value'=>$dataModal['sector_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'route_id','value'=>$dataModal['route_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'room_id','value'=>$dataModal['room_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'environment','value'=>0]) !!}
</form>
