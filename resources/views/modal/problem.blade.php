@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Signaler un problème']) !!}
{!! $Inputs::popupError([]) !!}


<form class="submit-form" data-route="{{ route('sendProblem') }}" onsubmit="submitData(this, closeProblemModal); return false">

    <div class="row">
        <div class="col s12">
            <p>
                Ah un problème ...<br>
                Décrit-nous le problème que tu as rencontré pour que nous puisssions le résoudre. Tu peux renseigner ton adresse mail si tu veux que nous te donnions un retour sur sa résolution.
            </p>
        </div>
    </div>

    <div class="row">
        {!! $Inputs::text(['name'=>'email', 'value'=>$dataModal['email'], 'label'=>'Ton e-mail (optionel)', 'placeholder'=>'si tu veux un retour','type'=>'email']) !!}
        {!! $Inputs::mdText(['name'=>'problem', 'value'=>'', 'label'=>'Problème', 'placeholder'=>'Dit-nous quel est le problème que tu as rencontré pour que nous puissions le résoudre']) !!}
        {!! $Inputs::Submit(['label'=>'Envoyer']) !!}
    </div>

    {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}
    {!! $Inputs::Hidden(['name'=>'id','value'=>$dataModal['id']]) !!}
    {!! $Inputs::Hidden(['name'=>'model','value'=>$dataModal['model']]) !!}
    {!! $Inputs::Hidden(['name'=>'page','value'=>'', 'id'=>'inputCurrentPage']) !!}
</form>
