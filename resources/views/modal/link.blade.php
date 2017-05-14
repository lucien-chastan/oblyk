@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, refresh); return false">

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>'Titre du lien', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'link', 'value'=>$dataModal['link'], 'label'=>'Url du lien', 'type'=>'url']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Description']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'linkable_type','value'=>'App\Crag']) !!}
    {!! $Inputs::Hidden(['name'=>'linkable_id','value'=>$dataModal['crag_id']]) !!}
</form>
