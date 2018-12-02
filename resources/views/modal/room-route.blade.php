@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" onsubmit="uploadRoutePicture(this, {{ $dataModal['callback'] }}, {{ $dataModal['gym_id'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        {!! $Inputs::upload(['name'=>'scheme', 'filter'=>'image/*', 'id'=>'upload-input-route-picture' ,'label'=>'Plan']) !!}
        {!! $Inputs::progressbar(['id'=>'progressbar-upload-scheme']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['route_id']]) !!}
</form>
