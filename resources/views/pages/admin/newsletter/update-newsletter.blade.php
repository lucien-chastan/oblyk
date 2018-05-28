@extends('layouts.admin', ['meta_title'=> 'Modifier news letter | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Modifier une news letter</h3>

    <form method="GET" onsubmit="getNewsletter(); return false;" class="col s12 l8 offset-l2">
        {!! $Inputs::text(['name'=>'ref', 'id'=>'newsletter_ref', 'value'=>'', 'label'=>'référence de la newsletter', 'placeholder'=>'référence de la newsletter','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Charger', 'cancelable'=>false]) !!}
    </form>

    <div id="insertNewsletter">

    </div>

@endsection