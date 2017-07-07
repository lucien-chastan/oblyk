@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" onsubmit="uploadCouverture(this, refresh); return false">

    <div class="row">
        {!! $Inputs::upload(['name'=>'file', 'filter'=>'image/*', 'id'=>'upload-input-couverture-topo' ,'label'=>'Couverture']) !!}
        {!! $Inputs::progressbar(['id'=>'progressbar-upload-couverture']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'topo_id','value'=>$dataModal['topo_id']]) !!}
</form>
