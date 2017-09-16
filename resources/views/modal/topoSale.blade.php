@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>trans('modals/buy.name'), 'type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>trans('modals/globalLabel.description')]) !!}
        {!! $Inputs::text(['name'=>'url', 'value'=>$dataModal['url'], 'label'=>trans('modals/buy.webSite'), 'type'=>'url']) !!}
        {!! $Inputs::localisation(['lat'=>$dataModal['lat'], 'lng'=>$dataModal['lng'], 'label'=>trans('modals/buy.localisation')]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'topo_id','value'=>$dataModal['topo_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
