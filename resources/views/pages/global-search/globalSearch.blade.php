<div id="global-search" class="side-global-search side-nav">

    <div id="progressSearch" class="progress">
        <div class="indeterminate"></div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">search</i>
            <input onkeyup="globalSearche(this)" id="icon_prefix" type="search">
            <label for="icon_prefix">Chercher sur oblyk</label>
        </div>

        <div class="col s12 tab-search-ligne">
            <ul class="tabs tabs-fixed-width text-center">
                <li class="tab col s1"><a class="active" href="#global-search-historique"><i class="material-icons">youtube_searched_for</i></a></li>
                <li class="tab col s1"><a href="#global-search-crag"><i class="material-icons">terrain</i></a></li>
                <li class="tab col s1"><a href="#global-search-route"><i class="material-icons">timeline</i></a></li>
                <li class="tab col s1"><a href="#global-search-user"><i class="material-icons">face</i></a></li>
                <li class="tab col s1"><a href="#global-search-lexique"><i class="material-icons">text_format</i></a></li>
                <li class="tab col s1"><a href="#global-search-aide"><i class="material-icons">school</i></a></li>
            </ul>
        </div>

        {{--HISTORIQUE DE RECHERCHE--}}
        <div id="global-search-historique" class="col s12 suggestion-recherche">
            <p><a href="/site-escalade/1/rocher-des-aures"><i class="material-icons left">terrain</i> Le Rocher des Aures</a></p>
            <p><a href="/site-escalade/2/arzelier"><i class="material-icons left">terrain</i> L'Arzelier</a></p>
        </div>

        <div id="global-search-crag" class="col s12">Un site d'escalade</div>
        <div id="global-search-route" class="col s12">Une ligne</div>
        <div id="global-search-user" class="col s12">Un grimpeur</div>
        <div id="global-search-lexique" class="col s12">Une définition</div>
        <div id="global-search-aide" class="col s12">Une aide</div>
    </div>


</div>