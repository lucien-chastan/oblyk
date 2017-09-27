@extends('layouts.admin', ['meta_title'=> 'Upload logo | Admin'])

@inject('Inputs','App\Lib\InputTemplates')

@section('content')

    <h3 class="loved-king-font text-center">Uploader logo &amp; Bandeau d'une SAE</h3>

    <form method="POST" name="uploadLogo" action="{{ route('uploadLogoBandeauSae') }}" enctype="multipart/form-data" class="col s12 l8 offset-l2">
        {{ csrf_field() }}
        {!! $Inputs::upload(['name'=>'logo', 'filter'=>'image/png', 'id'=>'logo-file', 'label'=>'Logo']) !!}
        {!! $Inputs::upload(['name'=>'bandeau', 'filter'=>'image/jpg', 'id'=>'bandeau-file', 'label'=>'Bandeau']) !!}
        {!! $Inputs::text(['name'=>'id', 'value'=>'', 'label'=>'Id de la salle', 'placeholder'=>'Id de la salle','type'=>'text']) !!}
        {!! $Inputs::Submit(['label'=>'uploader', 'cancelable'=>false]) !!}
    </form>

@endsection