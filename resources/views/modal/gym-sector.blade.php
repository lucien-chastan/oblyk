@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['gym_sector']->label, 'label'=>'Nom du secteur', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'group_sector', 'value'=>$dataModal['gym_sector']->group_sector, 'label'=>'Groupe¹', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'height', 'value'=>$dataModal['gym_sector']->height, 'label'=>"Hauteur(s) en mètre (voir note² si plusieurs longueurs)", 'type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['gym_sector']->description, 'label'=>'Description', 'type'=>'text']) !!}

        <div class="row">
            <div class="col s12">
                <p class="text-underline custom-collapse" onclick="collapseElement(this)" data-target="advanced-options-of-gym-sector" data-expanded="false">
                    <i class="material-icons left">arrow_right</i>Options avancées
                </p>
                <div id="advanced-options-of-gym-sector" class="hide">
                    {!! $Inputs::gymGradesSystem(['name'=>'gym_grade_id', 'gym_id'=>$dataModal['gym_id'], 'value'=>$dataModal['gym_sector']->gym_grade_id, 'label'=>'Système de cotation']) !!}
                    {!! $Inputs::gymRoutesTypes(['name'=>'preferred_type', 'value'=>$dataModal['gym_sector']->preferred_type, 'label'=>'Les lignes sont principalement des : ']) !!}
                </div>
            </div>
        </div>

        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
        <p class="text-underline">Note ¹ :</p>
        <p class="grey-text text-italic">
            Les secteurs ayant le même nom de groupe seront groupé dans la liste des secteurs
        </p>
        <p class="text-underline">Note ² :</p>
        <p class="grey-text text-italic">
            Si c'est un secteur en plusieurs longueurs, séparez les différentes variantes de hauteur par des points virgules.<br>
            Par exemple, un mur de 15 mètres en 3 longueurs de 5 mètres, renseignez : <strong>5;10;15</strong> comme hauteur.
        </p>
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'room_id','value'=>$dataModal['room_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym_sector']->id]) !!}
</form>
