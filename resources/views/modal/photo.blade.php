@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="{{ $dataModal['submit'] }}(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        @if($dataModal['id'] == '')
            {!! $Inputs::upload(['name'=>'file', 'filter'=>'image/*', 'id'=>'upload-input-photo' ,'label'=>'Photo']) !!}
            <div class="text-right">
                <span class="grey-text">Poids maximum : {{ env('PHOTO_MAX_SIZE_TEXT') }}</span>
            </div>
        @endif
            {!! $Inputs::albums(['name'=>'album_id', 'value'=>$dataModal['album_id'], 'label'=>trans('modals/photo.album')]) !!}
            {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>trans('modals/photo.description')]) !!}

            @if($dataModal['id'] == '')
                {!! $Inputs::progressbar(['id'=>'progressbar-upload-photo']) !!}
            @endif

            {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'illustrable_type','value'=>$dataModal['illustrable_type']]) !!}
    {!! $Inputs::Hidden(['name'=>'illustrable_id','value'=>$dataModal['illustrable_id']]) !!}
</form>
