<div id="global-search" class="side-global-search side-nav">

    <div id="progressSearch" class="progress">
        <div class="indeterminate"></div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">search</i>
            <input onkeyup="globalSearche(this)" id="input-text-global-search" type="search">
            <label for="input-text-global-search">Chercher sur oblyk</label>
        </div>

        <div class="col s12 tab-search-ligne">
            <ul class="tabs tabs-fixed-width text-center">
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-follow" href="#global-search-follow"><i class="material-icons">star</i></a></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-crag" href="#global-search-crag"><i class="material-icons">terrain</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-crag">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-gym" href="#global-search-gym"><img src="/img/icon-tab-gym.svg" class="icon-tab-global-search"></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-gym">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-route" href="#global-search-route"><i class="material-icons">timeline</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-route">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-topo" href="#global-search-topo"><i class="material-icons">local_library</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-topo">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-user" href="#global-search-user"><i class="material-icons">face</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-user">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-topic" href="#global-search-topic"><i class="material-icons">forum</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-topic">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-lexique" href="#global-search-lexique"><i class="material-icons">text_format</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-lexique">0</span></li>
                <li class="tab col s1"><a class="tab-global-search" id="tab-global-search-aide" href="#global-search-aide"><i class="material-icons">school</i></a><span class="count-tab-ettiquette scale-transition scale-out" id="nb-result-global-search-aide">0</span></li>
            </ul>
        </div>

        {{--HISTORIQUE DE RECHERCHE--}}
        <div id="global-search-follow" class="col s12 suggestion-recherche">

            @if(Auth::check())
                <p class="grey-text text-center">Chargement des favoris ...</p>
                <div class="text-center">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id-user-global-search" value="{{Auth::id()}}">
            @else
                <p class="grey-text text-center">Créer toi un compte pour garder en favoris les sites que tu visite le plus souvent</p>
                <input type="hidden" id="id-user-global-search" value="0">
            @endif
        </div>

        <div id="global-search-crag" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur les falaises</p></div>
        <div id="global-search-gym" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur les salles d'escalade</p></div>
        <div id="global-search-route" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur les lignes</p></div>
        <div id="global-search-topo" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur les topos</p></div>
        <div id="global-search-user" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur les grimpeurs</p></div>
        <div id="global-search-topic" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur le <a href="{{ route('forum') }}">forum</a></p></div>
        <div id="global-search-lexique" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur le <a href="{{ route('lexique') }}">lexique</a></p></div>
        <div id="global-search-aide" class="col s12"><p class="grey-text text-center">Ici apparaîtront les résultats de la recherche sur l'<a href="{{ route('help') }}">aide</a></p></div>
    </div>


</div>