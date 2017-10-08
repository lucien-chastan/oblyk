@extends('layouts.admin', ['meta_title'=> 'Créer article | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Créer un article</h3>

    <form method="POST" action="/articles" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        {!! $Inputs::text(['name'=>'label', 'value'=>'', 'label'=>'Titre de l\'article', 'placeholder'=>'Titre de l\'article','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'author', 'value'=>'', 'label'=>'Auteur', 'placeholder'=>'Auteur','type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>'', 'label'=>'Intro']) !!}
        {!! $Inputs::mdText(['name'=>'body', 'value'=>'', 'label'=>'Contenu']) !!}
        {!! $Inputs::Submit(['label'=>'Créer', 'cancelable'=>false]) !!}
    </form>

@endsection