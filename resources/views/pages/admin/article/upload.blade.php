@extends('layouts.admin', ['meta_title'=> 'Upload logo | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Uploader le bandeau d'un article</h3>

    <form method="POST" name="uploadBandeau" action="{{ route('uploadBandeauArticle') }}" enctype="multipart/form-data" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        {!! $Inputs::upload(['name'=>'bandeau', 'filter'=>'image/jpg', 'id'=>'bandeau-file', 'label'=>'Bandeau']) !!}
        {!! $Inputs::text(['name'=>'id', 'value'=>'', 'label'=>'Id de l\'article', 'placeholder'=>'Id de l\'article','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'uploader', 'cancelable'=>false]) !!}
    </form>

@endsection