@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::social(['name'=>'social_network_id', 'value'=>$dataModal['social_network_id'], 'label'=>trans('modals/socialNetwork.linkType')]) !!}
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>trans('modals/socialNetwork.linkTitle'), 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'url', 'value'=>$dataModal['url'], 'label'=>trans('modals/socialNetwork.linkUrl'), 'type'=>'url']) !!}

        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
