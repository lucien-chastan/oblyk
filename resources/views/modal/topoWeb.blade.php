@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{$dataModal['callback']}}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>trans('modals/webGuideBook.title'), 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'url', 'value'=>$dataModal['url'], 'label'=>trans('modals/webGuideBook.url'), 'type'=>'url']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
