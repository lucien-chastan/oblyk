@extends('layouts.admin', ['meta_title'=> 'Information voies | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Information sur une voie</h3>

    <form method="POST" name="uploadLogo" action="" class="col s12 l8 offset-l2">
        {!! $Inputs::text(['name'=>'id', 'value'=>'', 'label'=>'Id de la voie', 'placeholder'=>'Id de la voie','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'regarder', 'cancelable'=>false]) !!}
    </form>

    <div id="insert-route-information">

    </div>

@endsection