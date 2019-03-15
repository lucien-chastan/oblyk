@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$title]) !!}

<form class="submit-form" data-route="{{ $route }}" onsubmit="submitData(this, {{ $callback }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$gym_route->label, 'label'=>'Nom de la ligne [optionnel]', 'type'=>'text', 'col' => 's12 l8']) !!}
        {!! $Inputs::text(['name'=>'reference', 'value'=>$gym_route->reference, 'label'=>'Référence [optionnel]', 'type'=>'text', 'col' => 's12 l4']) !!}

        @if($gradeSystem->system_can_have_levels())
            {!! $Inputs::gymLevelGrade(['name'=>'gym_grade_line_id', 'value' => $gym_route->gym_grade_line_id, 'gym_grade_id'=>$gym_route->gym_grade_id, 'label'=>'Niveau', 'placeholder'=>"Niveau de cotation", "onChange" => "getDefaultRouteGrade(this)"]) !!}
        @endif

        @if($gradeSystem->needs_to_defined_grade() || $gradeSystem->difficulty_system == 2)
            {!! $Inputs::grade(['name'=>'grade', 'id'=>'gymRouteGradeText', 'required'=>false, 'label'=>'Cotation (voir note pour les multi-longueurs)', 'value'=>$gym_route->grades('text'), 'placeholder'=>"cotation, exemple 6a+, 5c, 7b/+, etc."]) !!}
        @endif

        @if($gradeSystem->needs_to_define_holds_color())
            @include('modal.partial.hold-color')
        @endif

        {!! $Inputs::mdText(['name'=>'description', 'value'=>$gym_route->description, 'label'=>'Description', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'opener', 'value'=>$gym_route->opener, 'label'=>'Ouvreur(s)', 'type'=>'text', 'col' => 's12 l6']) !!}
        {!! $Inputs::text(['name'=>'opener_date','required'=>true, 'value'=>$gym_route->opener_date->format('Y-m-d'), 'label'=>'Date d\'ouverture','type'=>'date', 'col' => 's12 l6', 'placeholder'=>'Date d\'ouverture']) !!}

        <div class="row">
            <div class="col s12">
                <p class="text-underline custom-collapse" onclick="collapseElement(this)" data-target="advanced-options-of-gym-route" data-expanded="false">
                    <i class="material-icons left">arrow_right</i>Options avancées
                </p>
                <div class="hide" id="advanced-options-of-gym-route">
                    @if(!$gradeSystem->needs_to_define_holds_color())
                        @include('modal.partial.hold-color')
                    @endif

                    @if(!$gradeSystem->needs_to_defined_grade() && $gradeSystem->difficulty_system != 2)
                        {!! $Inputs::grade(['name'=>'grade', 'id'=>'gymRouteGradeText', 'required'=>false, 'label'=>'Cotation (voir note pour les multi-longueurs)', 'value'=>$gym_route->grades('text'), 'placeholder'=>"cotation, exemple 6a+, 5c, 7b/+, etc."]) !!}
                    @endif

                    {!! $Inputs::text(['name'=>'height', 'required'=>true, 'value'=>$gym_route->height, 'label'=>'Hauteur en mètre (voir note pour les multi-longueurs)', 'type'=>'text']) !!}
                    {!! $Inputs::roomSectors(['name'=>'sector_id', 'value'=>$gym_route->sector_id, 'label'=>'Secteur', 'room_id'=>$room_id]) !!}
                    {!! $Inputs::gymRoutesTypes(['name'=>'type', 'value'=>$gym_route->type, 'label'=>'Type de la ligne']) !!}
                </div>
            </div>
        </div>

        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
        <p class="grey-text text-italic">
            Si c'est un secteur en plusieurs longueurs, séparez les différentes variantes par des points virgules.<br>
            Par exemple, un mur de 15 mètres en 3 longueurs de 5 mètres, renseignez : <strong>5;10;15</strong> comme hauteur et <strong>5a;5b;6b</strong> comme cotation.<br>
            Ce qui vous donne 3 variantes :<br>
            - un 5a de 5 mètres<br>
            - un 5b de 10 mètres<br>
            - un 6b de 15 mètres<br>
        </p>
    </div>

    {!! $Inputs::Hidden(['name'=>'id','value'=>$gym_route->id]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>$method]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$gym_id]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_grade_id','value'=>$gym_route->gym_grade_id]) !!}
</form>
