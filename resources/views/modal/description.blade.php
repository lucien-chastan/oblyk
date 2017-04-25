@inject('Inputs','App\Lib\InputTemplates')

<div class="row">
    <h5 class="loved-king-font text-center">Ajouter une description</h5>
</div>

<form onsubmit="submitData(); return false">
    <div class="row">
        {!! $Inputs::SimpleMde(['name'=>'description', 'value'=>'']) !!}
        {!! $Inputs::Submit([]) !!}
    </div>
</form>
