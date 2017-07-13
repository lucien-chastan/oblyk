@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        @if($dataModal['descriptive_type'] == 'App\Route')
            {!! $Inputs::note(['name'=>'note', 'value'=>$dataModal['note'], 'label'=>'Comment as-tu trouvé cette ligne ?']) !!}
        @endif
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Description']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    @if($dataModal['descriptive_type'] != 'App\Route')
        {!! $Inputs::Hidden(['name'=>'note','value'=>0]) !!}
    @endif
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_type','value'=>$dataModal['descriptive_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_id','value'=>$dataModal['descriptive_id']]) !!}
</form>
