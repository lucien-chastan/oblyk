@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="{{ $dataModal['submit'] }}(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError() !!}

    <div class="row">
        @if($dataModal['id'] == '')
            {!! $Inputs::upload(['name'=>'file', 'filter'=>'image/*', 'id'=>'upload-input-photo' ,'label'=>'Photo']) !!}
            <div class="text-right">
                <span class="grey-text">Poids maximum : {{ config('app.photo_max_size_text') }}, hauteur : {{ config('app.photo_max_height') }} et largeur : {{ config('app.photo_max_width') }}</span>
            </div>
        @endif

        {!! $Inputs::albums(['name'=>'album_id', 'value'=>$dataModal['album_id'], 'label'=>trans('modals/photo.album')]) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>$dataModal['description'], 'label'=>trans('modals/photo.description')]) !!}

        <p>Licence de la photo</p>
        {!! $Inputs::checkbox(['name'=>'copyright_by', 'checked'=>($dataModal['copyright_by'] == 1), 'label'=>trans('modals/photo.copyright_by')]) !!}
        {!! $Inputs::checkbox(['name'=>'copyright_nc', 'checked'=>($dataModal['copyright_nc'] == 1), 'label'=>trans('modals/photo.copyright_nc')]) !!}
        {!! $Inputs::checkbox(['name'=>'copyright_nd', 'checked'=>($dataModal['copyright_nd'] == 1), 'label'=>trans('modals/photo.copyright_nd')]) !!}
        {!! $Inputs::text(['name'=>'source', 'value'=>$dataModal['source'], 'label'=>trans('modals/photo.source')]) !!}

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
