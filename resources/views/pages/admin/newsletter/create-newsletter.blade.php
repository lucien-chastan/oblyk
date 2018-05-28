@extends('layouts.admin', ['meta_title'=> 'Créer newsletter | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Créer une news letter</h3>

    <form method="POST" action="/newsletters" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        {!! $Inputs::text(['name'=>'title', 'value'=>'', 'label'=>'Titre de la newsletter', 'placeholder'=>'Titre de la newsletter','type'=>'text']) !!}
        {!! $Inputs::text(['name'=>'ref', 'value'=>date('y-m'), 'label'=>'Référence (exemple 18-05)', 'placeholder'=>'Référence (exemple 18-05)','type'=>'text']) !!}
        {!! $Inputs::mdText(['name'=>'abstract', 'value'=>'', 'label'=>'Résumé']) !!}
        {!! $Inputs::mdText(['name'=>'content', 'value'=>'', 'label'=>'Contenu']) !!}
        {!! $Inputs::Submit(['label'=>'Créer', 'cancelable'=>false]) !!}
    </form>

@endsection