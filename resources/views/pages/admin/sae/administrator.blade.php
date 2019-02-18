@extends('layouts.admin', ['meta_title'=> 'Upload logo | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Ajouter une admin sur une salle</h3>

    <form method="POST" name="uploadLogo" action="{{ route('addGymAdmin') }}" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        {!! $Inputs::text(['name'=>'user_id', 'value'=>'', 'label'=>'Id du user', 'placeholder'=>'Id du user','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'gym_id', 'value'=>'', 'label'=>'Id de la salle', 'placeholder'=>'Id de la salle','type'=>'text']) !!}
        {!! $Inputs::hidden(['name'=>'format', 'value'=>'html']) !!}
        {!! $Inputs::Submit(['label'=>'enregistrer', 'cancelable'=>false]) !!}
    </form>

@endsection