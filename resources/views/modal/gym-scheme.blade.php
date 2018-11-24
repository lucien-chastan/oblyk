@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>$dataModal['title']]) !!}


<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, {{ $dataModal['callback'] }}); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        <p class="text-bold"><i class="material-icons left blue-text">map</i> Plan</p>
        <div class="col s12">
            {!! $Inputs::color(['name'=>'scheme_bg_color', 'value'=>$dataModal['gym_room']->scheme_bg_color ?? env('ROOM_SCHEME_BG_COLOR'), 'label'=>'Couleur du fond de plan', 'classLabel' => 'label-for-color-picker']) !!}
        </div>
    </div>

    <div class="row">
        <p class="text-bold"><i class="material-icons left blue-text">view_compact</i> Bandeau</p>
        <div class="col s12">
            {!! $Inputs::color(['name'=>'banner_color', 'value'=>$dataModal['gym_room']->banner_color ?? env('ROOM_BANNER_COLOR'), 'label'=>'Couleur de la police ', 'classLabel' => 'label-for-color-picker']) !!}
            {!! $Inputs::color(['name'=>'banner_bg_color', 'value'=>$dataModal['gym_room']->banner_bg_color ?? env('ROOM_BANNER_BG_COLOR'), 'label'=>'Couleur du bandeau ', 'classLabel' => 'label-for-color-picker']) !!}
            <div class="col s12">
                <input value="{{ $dataModal['gym_room']->banner_opacity ?? env('ROOM_BANNER_OPACITY') }}" width="20" id="banner_opacity" type="number" step="0.1" min="0" max="1" class="input-data" name="banner_opacity">
                <label for="banner_opacity" class="label-for-color-picker">Opacité du banndeau</label>
            </div>
        </div>
    </div>

    {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>$dataModal['method']]) !!}
    {!! $Inputs::Hidden(['name'=>'gym_id','value'=>$dataModal['gym_id']]) !!}
    {!! $Inputs::Hidden(['name'=>'room_id','value'=>$dataModal['gym_room']->id]) !!}
</form>
