@extends('layouts.admin', ['meta_title'=> 'Modifier Exception | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Modifier une Exceptions</h3>

    <form method="GET" onsubmit="getException(); return false;" class="col s12 l8 offset-l2">
        {!! $Inputs::text(['name'=>'label', 'id'=>'exception_id', 'value'=>'', 'label'=>'Id de l\'exception', 'placeholder'=>'Id de l\'exception','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Charger', 'cancelable'=>false]) !!}
    </form>

    <div id="insertException">

    </div>

@endsection