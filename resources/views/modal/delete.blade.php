@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupError([]) !!}

<form class="submit-form" data-route="{{ $dataModal['route'] }}" onsubmit="submitData(this, refresh); return false">

    {!! $Inputs::popupTitle(['title'=>'Supprimer un élément']) !!}
    {!! $Inputs::Hidden(['name'=>'_method','value'=>'DELETE']) !!}

    <div class="row">
        <p class="text-center">
            Êtes-vous sûr de vouloir supprimer cet élément ?<br>
            <span class="grey-text">(il n'y a pas de retour possible)</span>
        </p>
    </div>

    <div class="row">
        {!! $Inputs::Submit(['label'=>'Supprimer', 'color'=>'red']) !!}
    </div>
</form>
