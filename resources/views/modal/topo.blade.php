@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>'Titre du topo', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'author', 'value'=>$dataModal['author'], 'label'=>'Auteur du topo', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'editor', 'value'=>$dataModal['editor'], 'label'=>'Éditeur du topo', 'type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'editionYear', 'value'=>$dataModal['editionYear'], 'label'=>'Année d\'édition', 'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'price', 'value'=>$dataModal['price'], 'label'=>'Prix en euro', 'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'page', 'value'=>$dataModal['page'], 'label'=>'Nombre de page', 'type'=>'number']) !!}
        {!! $Inputs::text(['name'=>'weight', 'value'=>$dataModal['weight'], 'label'=>'Poids en gramme', 'type'=>'number']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
</form>
