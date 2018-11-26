@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['crag']->label, 'label'=>trans('modals/crag.name'), 'placeholder'=>trans('modals/crag.namePlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::rocks(['name'=>'rock_id', 'value'=>$dataModal['crag']->rock_id, 'label'=>trans('modals/crag.rock')]) !!}
        {!! $Inputs::text(['name'=>'city', 'value'=>$dataModal['crag']->city, 'label'=>trans('modals/crag.city'), 'placeholder'=>trans('modals/crag.cityPlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'region', 'value'=>$dataModal['crag']->region, 'label'=>trans('modals/crag.region'), 'placeholder'=>trans('modals/crag.regionPlaceholder'),'type'=>'text']) !!}
        {!! $Inputs::orientations(['value'=>$dataModal['crag']->orientation, 'orientable_type'=>'App\Crag', 'orientable_id'=>$dataModal['crag']->id, 'label'=>trans('modals/crag.orientation'), 'col'=>6]) !!}
        {!! $Inputs::seasons(['value'=>$dataModal['crag']->season, 'seasontable_type'=>'App\Crag', 'seasontable_id'=>$dataModal['crag']->id, 'label'=>trans('modals/crag.season'), 'col'=>6]) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['crag']->lat, 'lng'=>$dataModal['crag']->lng, 'label'=>trans('modals/crag.localisation')]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['crag']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'code_country','value'=>$dataModal['crag']->code_country]) !!}
    {!! $Inputs::Hidden(['name'=>'country','value'=>$dataModal['crag']->country]) !!}
</form>
