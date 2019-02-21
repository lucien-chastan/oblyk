@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        @if(!$dataModal['gym_room']->isPublished())
            <p class="text-center">
                Si vous avez fini de créer votre salle, vous pouvez la publier pour que les autres grimpeurs y ai accès
            </p>
            {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.visible')]) !!}
        @else
            <p class="text-center">
                Cacher ce topo le rendra invisble aux autres grimpeurs
            </p>
            {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.unvisible')]) !!}
        @endif
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['gym_room']->id]) !!}
</form>
