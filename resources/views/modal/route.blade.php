@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['ligne']->label, 'label'=>'Nom de la ligne', 'icon'=>'icon-nom', 'placeholder'=>'Nom de la ligne (exemple : Biographie)','type'=>'text']) !!}
        {!! $Inputs::sectors(['name'=>'sector_id', 'value'=>$dataModal['ligne']->sector_id, 'label'=>'Secteur', 'icon'=>'icon-sector', 'crag_id'=>1]) !!}
        {!! $Inputs::climbs(['name'=>'climb_id', 'value'=>$dataModal['ligne']->climb_id, 'label'=>'Type de grimpe', 'icon'=>'icon-type_grimpe',]) !!}
        {!! $Inputs::text(['name'=>'height', 'value'=>$dataModal['ligne']->height, 'label'=>'Hauteur', 'icon'=>'icon-route_height', 'placeholder'=>'Hauteur en mètre','type'=>'number']) !!}

        <div id="popup-route-nb-longueur">
            {!! $Inputs::text(['name'=>'nb_longueur', 'value'=>$dataModal['ligne']->nb_longueur, 'label'=>'Nombre de longueur', 'icon'=>'icon-nb_longueur', 'placeholder'=>'nombre de longueur de la voie','type'=>'number']) !!}
        </div>

        <div id="popup-route-type-cotation">
            {!! $Inputs::checkbox(['name'=>'type-cotation-longeur', 'label'=>'Une cotation par longueur', 'checked' => true, 'align' => 'right']) !!}
        </div>

        <div id="popup-route-table-longueur">
            <p class="text-right text-underline">Liste des longueurs</p>
            <table>
                <thead class="entete-popup-longueur-route">
                    <tr>
                        <th><span class="oblyk-icon icon-nb_longueur"></span></th>
                        <th><span class="oblyk-icon icon-cotation"></span></th>
                        <th class="width-50"><span class="oblyk-icon icon-ponderation"></span></th>
                        <th><span class="oblyk-icon icon-type_anchor"></span></th>
                        <th><span class="oblyk-icon icon-point"></span></th>
                        <th class="width-50"><span class="oblyk-icon icon-nb_point"></span></th>
                        <th><span class="oblyk-icon icon-inclinaison"></span></th>
                        <th class="width-50"><span class="oblyk-icon icon-route_height"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>L.1</td>
                        <td>{!! $Inputs::cotation(['grade'=>'2a', 'col'=>'s12', 'name'=>'cotation_longueur', 'label'=>'', 'icon'=>'']) !!}</td>
                        <td>{!! $Inputs::ponderation(['sub_grade'=>'', 'col'=>'s12', 'name'=>'ponderation_longueur', 'label'=>'', 'icon'=>'']) !!}</td>
                        <td>{!! $Inputs::relais(['name'=>'relais_longueur', 'value'=>'', 'label'=>'']) !!}</td>
                        <td>{!! $Inputs::point(['name'=>'point_longueur', 'value'=>'', 'label'=>'']) !!}</td>
                        <td>{!! $Inputs::text(['name'=>'nb_point_longueur', 'value'=>0, 'label'=>'', 'placeholder'=>'Année d\'ouverture','type'=>'number']) !!}</td>
                        <td>{!! $Inputs::inclinaison(['name'=>'incline_id_longeur', 'value'=>1, 'label'=>'']) !!}</td>
                        <td>{!! $Inputs::text(['name'=>'height_longueur', 'value'=>0, 'label'=>'', 'placeholder'=>'Hauteur en mètre','type'=>'number']) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="popup-route-cotation-incline">
            <div class="row">
                {!! $Inputs::cotation(['grade'=>'2a']) !!}
                {!! $Inputs::ponderation(['sub_grade'=>'']) !!}
            </div>
            {!! $Inputs::inclinaison(['name'=>'incline_id', 'value'=>$dataModal['ligne']->routeSections[0]->incline_id, 'label'=>'Inclinaison de la ligne', 'icon'=>'icon-inclinaison']) !!}
        </div>

        <div id="popup-route-equipement-zone">
            {!! $Inputs::text(['name'=>'nb_point', 'value'=>$dataModal['ligne']->routeSections[0]->nb_point, 'label'=>'Nombre de dégaine', 'icon'=>'icon-nb_point', 'placeholder'=>'Année d\'ouverture','type'=>'number']) !!}
            {!! $Inputs::point(['name'=>'point_id', 'value'=>$dataModal['ligne']->routeSections[0]->point_id, 'label'=>'Type de point', 'icon'=>'icon-point']) !!}
            {!! $Inputs::relais(['name'=>'anchor_id', 'value'=>$dataModal['ligne']->routeSections[0]->anchor_id, 'label'=>'Type de relais', 'icon'=>'icon-type_anchor']) !!}
        </div>

        <div id="popup-route-bloc-zone">
            {!! $Inputs::reception(['name'=>'reception_id', 'value'=>$dataModal['ligne']->routeSections[0]->reception_id, 'label'=>'Type de réception', 'icon'=>'icon-reception']) !!}
            {!! $Inputs::start(['name'=>'start_id', 'value'=>$dataModal['ligne']->routeSections[0]->start_id, 'label'=>'Type de départ', 'icon'=>'icon-type_depart']) !!}
        </div>

        {!! $Inputs::text(['name'=>'open_year', 'value'=>$dataModal['ligne']->open_year, 'label'=>'Année d\'ouverture', 'icon'=>'icon-open_year', 'placeholder'=>'Année d\'ouverture','type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'opener', 'value'=>$dataModal['ligne']->opener, 'label'=>'Nom des ouvreurs', 'icon'=>'icon-brosseur', 'placeholder'=>'Nom des ouvreurs de la ligne','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['ligne']->crag_id]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['ligne']->id]) !!}
</form>
