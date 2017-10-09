@extends('layouts.admin', ['meta_title'=> 'Supprimer exception | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Supprimer une exception</h3>

    <form method="GET" onsubmit="deleteException(); return false;" class="col s12 l8 offset-l2">
        {!! $Inputs::text(['name'=>'label', 'id'=>'exception_id', 'value'=>'', 'label'=>'Id de l\'exception', 'placeholder'=>'Id de l\'exception','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Supprimer', 'cancelable'=>false]) !!}
    </form>

@endsection