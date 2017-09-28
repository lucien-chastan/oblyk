@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        @if($dataModal['descriptive_type'] == 'App\Route')
            {!! $Inputs::note(['name'=>'note', 'value'=>$dataModal['note'], 'label'=>trans('modals/description.evaluationQuestion')]) !!}
        @endif
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>trans('modals/globalLabel.description')]) !!}
        @if($dataModal['descriptive_type'] == 'App\Route')
            {!! $Inputs::checkbox(['name'=>'private', 'id'=>'check-private' , 'label'=>trans('modals/cross.private_comment'), 'checked'=> ($dataModal['private'] == 1) ? 'true' : 'false', 'align'=>'right']) !!}
        @endif
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    @if($dataModal['descriptive_type'] != 'App\Route')
        {!! $Inputs::Hidden(['name'=>'note','value'=>0]) !!}
    @endif
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_type','value'=>$dataModal['descriptive_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'descriptive_id','value'=>$dataModal['descriptive_id']]) !!}
</form>
