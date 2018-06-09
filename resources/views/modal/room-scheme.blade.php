@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" onsubmit="uploadScheme(this, reloadCurrentVue, {{ $dataModal['gym_id'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::upload(['name'=>'scheme', 'filter'=>'image/*', 'id'=>'upload-input-scheme-topo' ,'label'=>'Plan']) !!}
        {!! $Inputs::progressbar(['id'=>'progressbar-upload-scheme']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['room_id']]) !!}
</form>
