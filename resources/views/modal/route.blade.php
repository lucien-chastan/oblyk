@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="setJsonLongueur();submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::sectors(['name'=>'sector_id', 'value'=>$dataModal['ligne']->sector_id, 'label'=>trans('modals/route.sector'), 'icon'=>'icon-sector', 'crag_id'=>$dataModal['ligne']->crag_id]) !!}
        {!! $Inputs::climbs(['name'=>'climb_id', 'value'=>$dataModal['ligne']->climb_id, 'label'=>trans('modals/route.ClimbType'), 'icon'=>'icon-type_grimpe',]) !!}
        {!! $Inputs::text(['name'=>'label', 'id'=>'popup_line_name', 'value'=>$dataModal['ligne']->label, 'label'=>trans('modals/route.name'), 'icon'=>'icon-nom', 'placeholder'=>trans('modals/route.namePlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'height', 'value'=>$dataModal['ligne']->height, 'label'=>trans('modals/route.height'), 'icon'=>'icon-route_height', 'placeholder'=>trans('modals/route.heightPlaceholder'),'type'=>'number']) !!}

        <div id="popup-route-nb-longueur">
            {!! $Inputs::text(['name'=>'nb_longueur', 'value'=>$dataModal['ligne']->nb_longueur, 'label'=>trans('modals/route.pitchNumber'), 'icon'=>'icon-nb_longueur', 'placeholder'=>trans('modals/route.pitchNumberPlaceholder'),'type'=>'number']) !!}
        </div>

        <div id="popup-route-type-cotation">
            {!! $Inputs::checkbox(['name'=>'type_cotation_longeur', 'label'=>trans('modals/route.oneGradeByPitch'), 'checked' => $dataModal['ligne']->typeCotation, 'align' => 'right']) !!}
        </div>

        <div id="popup-route-table-longueur">
            <p class="text-right text-underline">@lang('modals/route.pitchList')</p>
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
                <tbody id="tbody-liste-longueur">
                    <tr>
                        <td>L.1</td>
                        <td>{!! $Inputs::cotation(['grade'=>'2a', 'col'=>'s12', 'name'=>'cotation_longueur', 'label'=>'', 'icon'=>'']) !!}</td>
                        <td>{!! $Inputs::ponderation(['sub_grade'=>'', 'col'=>'s12', 'name'=>'ponderation_longueur', 'label'=>'', 'icon'=>'']) !!}</td>
                        <td>{!! $Inputs::relais(['name'=>'relais_longueur', 'value'=>'1', 'label'=>'']) !!}</td>
                        <td>{!! $Inputs::point(['name'=>'point_longueur', 'value'=>'1', 'label'=>'']) !!}</td>
                        <td>{!! $Inputs::text(['name'=>'nb_point_longueur', 'value'=>0, 'label'=>'', 'placeholder'=>trans('modals/route.openYearPlaceholder'),'type'=>'number']) !!}</td>
                        <td>{!! $Inputs::inclinaison(['name'=>'incline_id_longeur', 'value'=>1, 'label'=>'']) !!}</td>
                        <td>{!! $Inputs::text(['name'=>'height_longueur', 'value'=>0, 'label'=>'', 'placeholder'=>trans('modals/route.heightPlaceholder'),'type'=>'number']) !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="popup-route-cotation-incline">
            {{--<div class="row">--}}
                {{--{!! $Inputs::cotation(['grade'=>$dataModal['ligne']->routeSections[0]->grade]) !!}--}}
                {{--{!! $Inputs::ponderation(['sub_grade'=>$dataModal['ligne']->routeSections[0]->sub_grade]) !!}--}}
            {{--</div>--}}
            {!! $Inputs::grade(['name'=>'grade', 'label'=>'Cotation', 'value'=>$dataModal['ligne']->routeSections[0]->grade . $dataModal['ligne']->routeSections[0]->sub_grade, 'icon'=>'icon-grade', 'placeholder'=>"cotation, exemple 6a+, B8, ABO, etc."]) !!}
            {!! $Inputs::inclinaison(['name'=>'incline_id', 'value'=>$dataModal['ligne']->routeSections[0]->incline_id, 'label'=>trans('modals/route.incline'), 'icon'=>'icon-inclinaison']) !!}
        </div>

        <div id="popup-route-equipement-zone">
            {!! $Inputs::text(['name'=>'nb_point', 'value'=>$dataModal['ligne']->routeSections[0]->nb_point, 'label'=>trans('modals/route.drawNumber'), 'icon'=>'icon-nb_point','type'=>'number']) !!}
            {!! $Inputs::point(['name'=>'point_id', 'value'=>$dataModal['ligne']->routeSections[0]->point_id, 'label'=>trans('modals/route.pointType'), 'icon'=>'icon-point']) !!}
            {!! $Inputs::relais(['name'=>'anchor_id', 'value'=>$dataModal['ligne']->routeSections[0]->anchor_id, 'label'=>trans('modals/route.anchorType'), 'icon'=>'icon-type_anchor']) !!}
        </div>

        <div id="popup-route-bloc-zone">
            {!! $Inputs::reception(['name'=>'reception_id', 'value'=>$dataModal['ligne']->routeSections[0]->reception_id, 'label'=>trans('modals/route.receptionType'), 'icon'=>'icon-reception']) !!}
            {!! $Inputs::start(['name'=>'start_id', 'value'=>$dataModal['ligne']->routeSections[0]->start_id, 'label'=>trans('modals/route.startType'), 'icon'=>'icon-type_depart']) !!}
        </div>

        {!! $Inputs::text(['name'=>'open_year', 'value'=>$dataModal['ligne']->open_year, 'label'=>trans('modals/route.openYear'), 'icon'=>'icon-open_year', 'placeholder'=>trans('modals/route.openYearPlaceholder'),'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'opener', 'value'=>$dataModal['ligne']->opener, 'label'=>trans('modals/route.openerName'), 'icon'=>'icon-brosseur', 'placeholder'=>trans('modals/route.openerNamePlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['ligne']->crag_id]) !!}
    {!! $Inputs::Hidden(['name'=>'id', 'id'=>'popup_id_ligne', 'value'=>$dataModal['ligne']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'jsonLongueur','value'=>$dataModal['ligne']->tabLongueur]) !!}
</form>
