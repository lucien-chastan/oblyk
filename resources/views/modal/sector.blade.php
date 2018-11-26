@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['sector']->label, 'label'=>trans('modals/sector.name'), 'placeholder'=>trans('modals/sector.namePlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'approach','value'=>$dataModal['sector']->approach, 'label'=>trans('modals/sector.approach'), 'placeholder'=>trans('modals/sector.approachPlaceholder'), 'type'=>'number']) !!}
        {!! $Inputs::suns(['name'=>'sun_id','value'=>$dataModal['sector']->sun_id, 'label'=>trans('modals/sector.sunny')]) !!}
        {!! $Inputs::rains(['name'=>'rain_id','value'=>$dataModal['sector']->rain_id, 'label'=>trans('modals/sector.rain')]) !!}
        {!! $Inputs::orientations(['value'=>$dataModal['sector']->orientation, 'orientable_type'=>'App\Sector', 'orientable_id'=>$dataModal['sector']->id, 'label'=>trans('modals/sector.orientation'), 'col'=>6]) !!}
        {!! $Inputs::seasons(['value'=>$dataModal['sector']->season, 'seasontable_type'=>'App\Sector', 'seasontable_id'=>$dataModal['sector']->id, 'label'=>trans('modals/sector.season'), 'col'=>6]) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['sector']->lat, 'lng'=>$dataModal['sector']->lng, 'label'=>trans('modals/sector.localisation')]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['sector']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['sector']->crag_id]) !!}
</form>
