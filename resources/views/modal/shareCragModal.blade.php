@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<div>
    <h5 class=""><i class="material-icons left">code</i> @lang('modals/shareCrag.integrateTitle') </h5>

    {!! $Inputs::mdText(['name'=>'iframe', 'value'=>'<iframe src="' . route('cragIframe', ['crag_id' => $dataModal['crag']->id]) . '" width="100%" height="150px" frameborder="0"></iframe>', 'label'=>'']) !!}

    <iframe src="{{route('cragIframe', ['crag_id' => $dataModal['crag']->id]) }}" width="100%" height="150px" frameborder="0"></iframe>

</div>

<div>
    <h5 class=""><i class="material-icons left">link</i> @lang('modals/shareCrag.linkTitle') </h5>
    {!! $Inputs::text(['name'=>'lien', 'value'=> route('cragPage', ['crag_id' => $dataModal['crag']->id, 'crag_label' => str_slug($dataModal['crag']->label)]), 'label'=>'', 'type'=>'text']) !!}
</div>
