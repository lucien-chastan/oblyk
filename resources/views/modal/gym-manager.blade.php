@inject('Inputs','App\Lib\InputTemplates')

{!! $Inputs::popupTitle(['title'=>'Je suis le gérant']) !!}

<form class="submit-form" data-route="{{ route('sendManagerRequest') }}" onsubmit="submitData(this, closeManagerModal); return false">

    {!! $Inputs::popupError([]) !!}

    <div class="row">
        <div class="col s12">
            <p>
                @if(Auth::guest())
                    <i class="material-icons left">check_box_outline_blank</i>
                @else
                    <i class="material-icons left green-text">check_box</i>
                @endif
                <strong>Étape 1 :</strong> Créez-vous un compte sur oblyk<br>
                @if(Auth::guest())
                    <cite class="grey-text">(préférez créer un compte à votre nom plutôt qu'au nom de votre salle)</cite>
                @endif
            </p>
            @if(Auth::guest())
                <div class="text-center">
                    <a href="{{ route('register') }}" class="btn-flat"><i class="material-icons left">person_add</i>Créer un compte</a>
                    <a href="{{ route('login') }}" class="btn-flat"><i class="material-icons left">person</i>Me connecter</a>
                </div>
            @endif

            <p>
                <i class="material-icons left">check_box_outline_blank</i>
                <strong>Étape 2 :</strong> Justifier mon droit d'administrer cette salle<br>
            </p>
            @if(Auth::check())
                <p>
                    Nous aimerions vérifier que vous avez bien le droit d'administrer cette page, pourriez-vous nous donner des éléments qui justifieraient ça ?<br>
                </p>
                {!! $Inputs::hidden(['name'=>'gym_id', 'value'=>$gym_id, 'label'=>'id de la salle', 'placeholder'=>'Id de la salle','type'=>'email']) !!}
                {!! $Inputs::mdText(['name'=>'justification', 'value'=>'', 'label'=>'Justification', 'placeholder'=>'Merci de nous donner']) !!}
                <p>
                    <cite class="grey-text">Exemple : si vous avez une adresse mail liée au nom de domaine de la salle (moi@<mark class="blue lighten-5">ma-salle.com</mark> - www.<mark class="blue lighten-5">ma-salle.com</mark>), ou si vous êtes sur l'organigramme de l'asso / entreprise, etc.</cite>
                </p>
                {!! $Inputs::Submit(['label'=>trans('modals/globalLabel.submit')]) !!}
            @endif

            {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}
        </div>
    </div>
</form>
