@inject('Inputs','App\Lib\InputTemplates')


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    {!! $Inputs::popupTitle(['title'=>trans('modals/headband.modalTitle')]) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'photo_id','value'=>$dataModal['photo']->id]) !!}

    <div class="row">
        <p class="text-center">
            @lang('modals/headband.question')<br>
        </p>
    </div>

    <div class="row">
        {!! $Inputs::Submit(['label'=>trans('modals/headband.defines')]) !!}
    </div>
</form>
