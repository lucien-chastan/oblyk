<form id="form-dashboard-setting" class="submit-form" data-route="{{route('saveUserSettings')}}" onsubmit="submitData(this, majSettingsDashboard); return false">

    <h2 class="loved-king-font titre-profile-boite-vue">Choix des boîtes qui sont affichées sur mon Dashboard</h2>

    {!! $Inputs::popupError([]) !!}

    <div class="blue-border-zone explication-dash-option">

        {{--WELCOME--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_welcome', 'label'=>'Boîte de bienvenu', 'checked' => ($user->settings->dash_welcome == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche une boîte qui te souhaites la bienvenue et t'explique le fonctionnement du dashboard</p>
        </div>

        {{--CROIX DES POTES--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_friend_cross', 'label'=>'Croix des potes', 'checked' => ($user->settings->dash_friend_cross == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche une boîte qui te montre les dernières réalisation de tes potes</p>
        </div>

        {{--TES CROIX--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_my_cross', 'label'=>'Résumé de mes croix', 'checked' => ($user->settings->dash_my_cross == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche une boîte qui te présente un rapide résumé de tes croix</p>
        </div>

        {{--COMMENTAIRES--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_comments', 'label'=>'Les derniers commentaire', 'checked' => ($user->settings->dash_comments == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les derniers commentaires postée sur des voies sur oblyk</p>
        </div>

        {{--FALAISE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_crags', 'label'=>'Les dernières falaises ajoutées', 'checked' => ($user->settings->dash_crags == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les dernières falaises qui ont étées ajoutées sur oblyk</p>
        </div>

        {{--LE FORUM--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_forum', 'label'=>'Les dernières sujets du forum', 'checked' => ($user->settings->dash_forum == 1) ? true : false, 'align' => 'left']) !!}
            <p>Te présente un rapide aperçu de ce qui se passe sur le forum</p>
        </div>

        {{--LISTE DES FALAISES ET SALLE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_list_crag_sae', 'label'=>'Arbre des falaises et salles', 'checked' => ($user->settings->dash_list_crag_sae == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche sous forme d'arbre les falaises et salles d'oblyk, rangé par pays, régions, puis ville</p>
        </div>

        {{--DERNIER ARTICLE D'OBLYK--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_oblyk_news', 'label'=>'Oblyk news', 'checked' => ($user->settings->dash_oblyk_news == 1) ? true : false, 'align' => 'left']) !!}
            <p>Te présente les derniers articles postés sur oblyk</p>
        </div>

        {{--RECHERCHE DE PARTENAIRE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_partenaire', 'label'=>'Recherche de partenaire', 'checked' => ($user->settings->dash_partenaire == 1) ? true : false, 'align' => 'left']) !!}
            <p>Cette boîte te résime l'activité de ta recherche de partenaire d'escalade</p>
        </div>

        {{--DERNIÈRE PHOTOS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_photos', 'label'=>'Dernières photos', 'checked' => ($user->settings->dash_photos == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les dernières photos postées sur oblyk</p>
        </div>

        {{--DERNIÈRES LIGNES--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_routes', 'label'=>'Dernières voies', 'checked' => ($user->settings->dash_routes == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les dernières voies, blocs, grande-voies, etc. postés sur oblyk</p>
        </div>

        {{--DERNIÈRES SAE--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_sae', 'label'=>'Dernières salles', 'checked' => ($user->settings->dash_sae == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les dernières salles postées sur oblyk</p>
        </div>

        {{--DERNIERS TOPOS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_topos', 'label'=>'Derniers topos', 'checked' => ($user->settings->dash_topos == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les derniers topos postés sur oblyk</p>
        </div>

        {{--DERNIERS GRIMPEURS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_users', 'label'=>'Derniers topos', 'checked' => ($user->settings->dash_users == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les derniers grimpeurs arrivés sur oblyk</p>
        </div>

        {{--DERNIÈRES VIDÉOS--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_videos', 'label'=>'Dernières vidéos', 'checked' => ($user->settings->dash_videos == 1) ? true : false, 'align' => 'left']) !!}
            <p>Affiche les dernières vidéos postées sur oblyk</p>
        </div>

        {{--MOT AU HASARD--}}
        <div class="blue-border-div">
            {!! $Inputs::checkbox(['name'=>'dash_random_word', 'label'=>'Le mot au hasard', 'checked' => ($user->settings->dash_random_word == 1) ? true : false, 'align' => 'left']) !!}
            <p>Un boîte qui te présente un mot au hasard du lexique de l'escalade </p>
        </div>

        {!! $Inputs::Hidden(['name'=>'_method','value'=>'POST']) !!}

        <div class="row">
            {!! $Inputs::Submit(['label'=>'Enregistrer', 'cancelable' => false]) !!}
        </div>

    </div>
</form>