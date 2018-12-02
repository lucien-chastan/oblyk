
@inject('Inputs','App\Lib\InputTemplates')

<form class="col s12 l8 offset-l2" id="formUpdateArticle" data-route="/articles/{{ $article->id }}" onsubmit="submitData(this, articleUpdated); return false">

    {!! $Inputs::popupError() !!}

    {{ csrf_field() }}
    {!! $Inputs::text(['name'=>'id', 'value'=>$article->id, 'label'=>'Id de l\'article', 'placeholder'=>'Id de l\'article','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'label', 'value'=>$article->label, 'label'=>'Titre de l\'article', 'placeholder'=>'Titre de l\'article','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'author', 'value'=>$article->author, 'label'=>'Auteur', 'placeholder'=>'Auteur','type'=>'text']) !!}
    {!! $Inputs::text(['name'=>'views', 'value'=>$article->views, 'label'=>'Vue', 'placeholder'=>'Vue','type'=>'number']) !!}
    {!! $Inputs::mdText(['name'=>'description', 'value'=>$article->description, 'label'=>'Intro']) !!}
    {!! $Inputs::mdText(['name'=>'body', 'value'=>$article->body, 'label'=>'Contenu']) !!}
    {!! $Inputs::checkbox(['name'=>'publish', 'checked'=>($article->publish == 1), 'label'=>'Publier']) !!}
    {!! $Inputs::Submit(['label'=>'Modifier', 'cancelable'=>false]) !!}

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'PUT']) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$article->id]) !!}
</form>

