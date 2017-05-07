@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, refresh); return false">

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_type','value'=>'App\Crag']) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_id','value'=>$dataModal['crag_id']]) !!}

    <div class="row">
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Description']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>
</form>
