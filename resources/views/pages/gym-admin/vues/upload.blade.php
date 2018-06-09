@inject('Inputs','App\Lib\InputTemplates')

<h3 class="title-admmin-gym">Changer le bandeau de {{ $gym->label }}</h3>

<form method="POST" name="uploadLogo" action="{{ route('uploadLogoBandeauSae') }}" enctype="multipart/form-data" class="col s12 l8 offset-l2">
    {{ csrf_field() }}
    {!! $Inputs::upload(['name'=>'logo', 'filter'=>'image/png', 'id'=>'logo-file', 'label'=>'Logo']) !!}
    {!! $Inputs::upload(['name'=>'bandeau', 'filter'=>'image/jpg', 'id'=>'bandeau-file', 'label'=>'Bandeau']) !!}
    {!! $Inputs::hidden(['name'=>'id', 'value'=> $gym->id, 'label'=>'Id de la salle', 'type'=>'text']) !!}
    {!! $Inputs::Submit(['label'=>'uploader', 'cancelable'=>false]) !!}
</form>
