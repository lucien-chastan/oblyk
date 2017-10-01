@extends('layouts.admin', ['meta_title'=> 'Information voies | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Information sur une voie</h3>

    <div class="row">
        <form method="POST" name="uploadLogo" onsubmit="getRoute(); return false" class="col s12 l8 offset-l2">
            {!! $Inputs::text(['name'=>'id', 'value'=>'', 'id'=>'route_id', 'label'=>'Id de la voie', 'placeholder'=>'Id de la voie','type'=>'text']) !!}
            {!! $Inputs::Submit(['label'=>'regarder', 'cancelable'=>false]) !!}
        </form>
    </div>

    <div class="row" id="insert-route-information">

    </div>

@endsection