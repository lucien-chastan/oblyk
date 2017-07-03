@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="uploadPhoto(this, {{ $dataModal['callback'] }}); return false">

    <div class="row">
        {!! $Inputs::upload(['name'=>'file', 'id'=>'upload-input-photo' ,'label'=>'Photo']) !!}
        {!! $Inputs::albums(['name'=>'album_id', 'value'=>$dataModal['album_id'], 'label'=>'Album']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>'Description de la photo']) !!}
        {!! $Inputs::progressbar(['id'=>'progressbar-upload-photo']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'illustrable_type','value'=>$dataModal['illustrable_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'illustrable_id','value'=>$dataModal['illustrable_id']]) !!}
</form>
