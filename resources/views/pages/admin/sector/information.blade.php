@extends('layouts.admin', ['meta_title'=> 'Information secteur | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Information sur un secteur</h3>

    <div class="row">
        <form method="POST" name="uploadLogo" onsubmit="getSector(); return false" class="col s12 l8 offset-l2">
            {!! $Inputs::text(['name'=>'id', 'value'=>'', 'id'=>'sector_id', 'label'=>'Id du secteur', 'placeholder'=>'Id du secteur','type'=>'text']) !!}
            {!! $Inputs::Submit(['label'=>'regarder', 'cancelable'=>false]) !!}
        </form>
    </div>

    <div class="row" id="insert-sector-information">

    </div>

@endsection