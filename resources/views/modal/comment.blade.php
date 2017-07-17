@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::mdText(['name'=>'comment', 'value'=>$dataModal['comment'], 'label'=>'Votre commentaire']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'commentable_type','value'=>$dataModal['commentable_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'commentable_id','value'=>$dataModal['commentable_id']]) !!}
</form>
