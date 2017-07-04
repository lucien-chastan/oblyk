@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupError([]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupTitle(['title'=>'Définir comme bandeau']) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}
    {!! $Inputs::Hidden(['name'=>'crag_id','value'=>$dataModal['crag']->id]) !!}
    {!! $Inputs::Hidden(['name'=>'photo_id','value'=>$dataModal['photo']->id]) !!}

    <div class="row">
        <p class="text-center">
            Voulez-vous définir cette photo comme photo de bandeau de ce site ?<br>
        </p>
    </div>

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Définir']) !!}
    </div>
</form>
