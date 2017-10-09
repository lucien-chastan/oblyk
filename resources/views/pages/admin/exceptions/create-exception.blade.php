@extends('layouts.admin', ['meta_title'=> 'Créer exceptions | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Créer une Exceptions</h3>

    <form method="POST" action="/exceptions" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        <div class="input-field col s12">
            <select name="exception_type">
                <option value="1" selected>Interdit</option>
                <option value="2">Accès restreint</option>
                <option value="3">FFME</option>
                <option value="4">Green Spits</option>
            </select>
            <label>Materialize Select</label>
        </div>
        {!! $Inputs::text(['name'=>'crag_id', 'value'=>'', 'label'=>'Id du site', 'placeholder'=>'Id du site','type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>'', 'label'=>'description']) !!}
        {!! $Inputs::Submit(['label'=>'Créer', 'cancelable'=>false]) !!}
    </form>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
@endsection