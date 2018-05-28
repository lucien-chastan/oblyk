
@inject('Inputs','App\Lib\InputTemplates')

<form class="col s12 l8 offset-l2" id="formUpdateNewsletter" data-route="/newsletters/{{ $newsletter->ref }}" onsubmit="submitData(this, newsletterUpdated); return false">

    {!! $Inputs::popupError([]) !!}

    {{ csrf_field() }}
    {!! $Inputs::text(['name'=>'ref', 'value'=>$newsletter->ref, 'label'=>'Référence de la newsletter', 'placeholder'=>'Référence de la newsletter','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'title', 'value'=>$newsletter->title, 'label'=>'Titre de la newsletter', 'placeholder'=>'Titre de la newsletter','type'=>'text']) !!}
    {!! $Inputs::mdText(['name'=>'abstract', 'value'=>$newsletter->abstract, 'label'=>'Résumé']) !!}
    {!! $Inputs::mdText(['name'=>'content', 'value'=>$newsletter->content, 'label'=>'Contenu']) !!}
    {!! $Inputs::Submit(['label'=>'Modifier', 'cancelable'=>false]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'PUT']) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$newsletter->id]) !!}
</form>

