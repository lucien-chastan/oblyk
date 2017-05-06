@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Ajouter une description']) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" method="POST" data-route="/descriptions" onsubmit="submitData(this, refresh); return false">
    <div class="row">
        {!! $Inputs::Hidden(['name'=>'id','value'=>'']) !!}
        {!! $Inputs::Hidden(['name'=>'descriptive_type','value'=>'App\Crag']) !!}
        {!! $Inputs::Hidden(['name'=>'descriptive_id','value'=>$request]) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>'', 'label'=>'Description']) !!}
        {!! $Inputs::Submit(['label'=>'Ajouter']) !!}
    </div>
</form>
