@extends('layouts.admin', ['meta_title'=> 'Upload logo | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Modifier un article</h3>

    <form method="GET" onsubmit="getArticle(); return false;" class="col s12 l8 offset-l2">
        {!! $Inputs::text(['name'=>'label', 'id'=>'article_id', 'value'=>'', 'label'=>'Id de l\'article', 'placeholder'=>'Id de l\'article','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'Charger', 'cancelable'=>false]) !!}
    </form>

    <div id="insertArticle">

    </div>

@endsection