@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <h5 class="loved-king-font text-center popup-title">Ajouter une description</h5>
</div>

<form onsubmit="submitData('/ajax-data/description', refresh); return false">
    <div class="row">
        {!! $Inputs::Hidden(['name'=>'id','value'=>'']) !!}
        {!! $Inputs::Hidden(['name'=>'type','value'=>'App\Crag']) !!}
        {!! $Inputs::Hidden(['name'=>'type_id','value'=>$request]) !!}
        {!! $Inputs::mdText(['name'=>'description', 'value'=>'', 'label'=>'Description']) !!}
        {!! $Inputs::Submit(['label'=>'ajouter']) !!}
    </div>
</form>
