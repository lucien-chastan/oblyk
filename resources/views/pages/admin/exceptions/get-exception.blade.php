
@inject('Inputs','App\Lib\InputTemplates')

<form class="col s12 l8 offset-l2" id="formUpdateHelp" data-route="/exceptions/{{ $exception->id }}" onsubmit="submitData(this, helpUpdated); return false">

    {!! $Inputs::popupError([]) !!}

    {{ csrf_field() }}
    {!! $Inputs::text(['name'=>'id', 'value'=>$exception->id, 'label'=>'Id de l\'exception', 'placeholder'=>'Id de l\'exception','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'crag_id', 'value'=>$exception->crag_id, 'label'=>'Id de la falaise', 'placeholder'=>'Id de la falaise','type'=>'text']) !!}
    <div class="input-field col s12">
        <select class="input-data" name="exception_type">
            <option value="1" {{ ($exception->exception_type == 1) ? 'selected' : '' }}>Interdit</option>
            <option value="2" {{ ($exception->exception_type == 2) ? 'selected' : '' }}>Accès restreint</option>
            <option value="3" {{ ($exception->exception_type == 3) ? 'selected' : '' }}>FFME</option>
            <option value="4" {{ ($exception->exception_type == 3) ? 'selected' : '' }}>Green Spits</option>
        </select>
        <label>Materialize Select</label>
    </div>
    {!! $Inputs::mdText(['name'=>'description', 'value'=>$exception->description, 'label'=>'description']) !!}
    {!! $Inputs::Submit(['label'=>'Modifier', 'cancelable'=>false]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'PUT']) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$exception->id]) !!}
</form>

