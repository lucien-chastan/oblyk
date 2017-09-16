@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="{{ $dataModal['submit'] }}(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        @if($dataModal['id'] == '')
            {!! $Inputs::upload(['name'=>'file', 'filter'=>'application/pdf', 'id'=>'upload-input-topo' ,'label'=>'Fichier PDF']) !!}
        @endif

            {!! $Inputs::text(['name'=>'label', 'value'=>$dataModal['label'], 'label'=>'Titre du topo', 'type'=>'text']) !!}
            {!! $Inputs::text(['name'=>'author', 'value'=>$dataModal['author'], 'label'=>'Auteur du topo', 'type'=>'text']) !!}
            {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Description du topo']) !!}

            @if($dataModal['id'] == '')
                {!! $Inputs::progressbar(['id'=>'progressbar-upload-topo']) !!}
            @endif

            {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag_id']]) !!}
</form>
