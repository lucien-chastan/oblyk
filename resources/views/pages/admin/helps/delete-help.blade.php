@extends('layouts.admin', ['meta_title'=> 'Supprimer aide | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Supprimer une aides</h3>

    <form method="GET" onsubmit="deleteHelp(); return false;" class="col s12 l8 offset-l2">
        {!! $Inputs::text(['name'=>'label', 'id'=>'help_id', 'value'=>'', 'label'=>'Id de l\'aide', 'placeholder'=>'Id de l\'aide','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Supprimer', 'cancelable'=>false]) !!}
    </form>

@endsection