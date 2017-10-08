
@inject('Inputs','App\Lib\InputTemplates')

<form class="col s12 l8 offset-l2" id="formUpdateHelp" data-route="/helps/{{ $help->id }}" onsubmit="submitData(this, helpUpdated); return false">

    {!! $Inputs::popupError([]) !!}

    {{ csrf_field() }}
    {!! $Inputs::text(['name'=>'id', 'value'=>$help->id, 'label'=>'Id de l\'aide', 'placeholder'=>'Id de l\'aide','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'label', 'value'=>$help->label, 'label'=>'Titre de l\'aide', 'placeholder'=>'Titre de l\'aide','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'category', 'value'=>$help->category, 'label'=>'Category', 'placeholder'=>'category','type'=>'text']) !!}
    {!! $Inputs::mdText(['name'=>'contents', 'value'=>$help->contents, 'label'=>'Contenu']) !!}
    {!! $Inputs::Submit(['label'=>'Modifier', 'cancelable'=>false]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'PUT']) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$help->id]) !!}
</form>

