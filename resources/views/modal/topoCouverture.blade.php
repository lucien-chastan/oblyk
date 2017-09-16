@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" onsubmit="uploadCouverture(this, refresh); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        {!! $Inputs::upload(['name'=>'file', 'filter'=>'image/*', 'id'=>'upload-input-couverture-topo' ,'label'=>trans('modals/guidebookCover.cover')]) !!}
        {!! $Inputs::progressbar(['id'=>'progressbar-upload-couverture']) !!}
        {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'topo_id','value'=>$dataModal['topo_id']]) !!}
</form>
