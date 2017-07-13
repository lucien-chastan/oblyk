@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::social(['name'=>'social_network_id', 'value'=>$dataModal['social_network_id'], 'label'=>'Type de lien']) !!}
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>'Titre du lien (optionnel)', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'url', 'value'=>$dataModal['url'], 'label'=>'Url du lien', 'type'=>'url']) !!}

        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
