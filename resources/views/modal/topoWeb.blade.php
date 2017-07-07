@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{$dataModal['callback']}}); return false">

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>'Titre du topo', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'url', 'value'=>$dataModal['url'], 'label'=>'Url du topo web', 'type'=>'url']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
