@extends('layouts.admin', ['meta_title'=> 'Créer aide | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Créer une aide</h3>

    <form method="POST" action="/helps" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        {!! $Inputs::text(['name'=>'label', 'value'=>'', 'label'=>'Titre', 'placeholder'=>'Titre','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'category', 'value'=>'', 'label'=>'Catégorie', 'placeholder'=>'Catégorie','type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'contents', 'value'=>'', 'label'=>'Contenu']) !!}
        {!! $Inputs::Submit(['label'=>'Créer', 'cancelable'=>false]) !!}
    </form>

@endsection