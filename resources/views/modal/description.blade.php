@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    <div class="row">
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Description']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_type','value'=>$dataModal['descriptive_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_id','value'=>$dataModal['descriptive_id']]) !!}
</form>
