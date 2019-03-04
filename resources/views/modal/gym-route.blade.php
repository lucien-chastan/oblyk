@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym_route']->label, 'label'=>'Nom de la ligne', 'type'=>'text', 'col' => 's12 l8']) !!}
        {!! $Inputs::text(['name'=>'reference', 'value'=>$dataModal['gym_route']->reference, 'label'=>'Référence de la ligne', 'type'=>'text', 'col' => 's12 l4']) !!}
        {!! $Inputs::gymLevelGrade(['name'=>'gradeLine', 'gym_grade_id'=>$dataModal['sector']->gym_grade_id ?? $dataModal['room']->gym_grade_id, 'label'=>'Niveau', 'value'=>$dataModal['estimateGradeLevel'], 'placeholder'=>"Niveau de cotation", "onChange" => "getDefaultRouteGrade(this)"]) !!}
        {!! $Inputs::grade(['name'=>'grade', 'id'=>'gymRouteGradeText', 'required'=>true, 'label'=>'Cotation (voir note pour les multi-longueurs)', 'value'=>$dataModal['gym_route']->grades('text'), 'placeholder'=>"cotation, exemple 6a+, 5c, 7b/+, etc."]) !!}
        <div class="row">
            <div class="col s12">
                <div class="col s12 l6">
                    <p class="text-underline">Couleur</p>
                    {!! $Inputs::colorList(['name'=>'color_first', 'id'=>'firstColorGymRoute', 'label'=>'Première couleur', 'value'=>$dataModal['colors'][0] ?? '#f2f2f2', 'placeholder'=>"Première couleur"]) !!}
                </div>
                <div class="col s12 l6">
                    <p class="text-underline">
                        {!! $Inputs::checkbox(['name'=>'use_second_color', 'id'=>'useSecondColorGymRoute', 'checked'=>($dataModal['use_second_color'] == 1), 'label' => 'Utiliser une seconde couleur']) !!}
                    </p>
                    {!! $Inputs::colorList(['name'=>'color_second', 'id'=>'secondColorGymRoute', 'label'=>'Second couleur', 'value'=>$dataModal['colors'][1] ?? '#f2f2f2', 'placeholder'=>"Seconde couleur"]) !!}
                </div>
            </div>
        </div>
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym_route']->description, 'label'=>'Description', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'opener', 'value'=>$dataModal['gym_route']->opener, 'label'=>'Ouvreur(s)', 'type'=>'text', 'col' => 's12 l6']) !!}
        {!! $Inputs::text(['name'=>'opener_date','required'=>true, 'value'=>$dataModal['gym_route']->opener_date->format('Y-m-d'), 'label'=>'Date d\'ouverture','type'=>'date', 'col' => 's12 l6', 'placeholder'=>'Date d\'ouverture']) !!}
        <p class="text-underline">Réglage par défaut (au niveau du secteur)</p>
        {!! $Inputs::text(['name'=>'height', 'required'=>true, 'value'=>$dataModal['gym_route']->height, 'label'=>'Hauteur en mètre (voir note pour les multi-longueurs)', 'type'=>'text']) !!}
        {!! $Inputs::roomSectors(['name'=>'sector_id', 'value'=>$dataModal['gym_route']->sector_id, 'label'=>'Secteur', 'room_id'=>$dataModal['room_id']]) !!}
        {!! $Inputs::gymRoutesTypes(['name'=>'type', 'value'=>$dataModal['gym_route']->type, 'label'=>'Type de la ligne']) !!}
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

    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym_route']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
</form>
