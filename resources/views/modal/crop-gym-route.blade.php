@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" onsubmit="uploadRouteCrop(this, {{ $dataModal['callback'] }}, {{ $dataModal['gym_id'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        <div class="col s12">
            <img id="original-picture-for-crop" src="{{ $dataModal['route']->picture(1300) }}" alt="">
        </div>
    </div>

    {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['route_id']]) !!}
</form>
