@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>trans('modals/link.linkTitle'), 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'link', 'value'=>$dataModal['link'], 'label'=>trans('modals/link.url'), 'type'=>'url']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>trans('modals/globalLabel.description')]) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'linkable_type','value'=>$dataModal['linkable_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'linkable_id','value'=>$dataModal['linkable_id']]) !!}
</form>
