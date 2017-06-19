@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['ligne']->label, 'label'=>'Nom de la ligne', 'placeholder'=>'Nom de la ligne (exemple : Biographie)','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['ligne']->id]) !!}
</form>
