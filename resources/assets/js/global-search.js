let timToGlobalSearch,
    saveSearch;

//SÉLECTIONNE L'ONGLET HISTORIQUE À L'OUVERTURE DE LA ZONE RECHERCHE
window.onload = function () {
    let openBt = document.getElementsByClassName('button-open-global-search');
    for(let i = 0 ; i < openBt.length ; i++){
        openBt[i].addEventListener('click', function () {
            let iptSearch = document.getElementById('input-text-global-search');
            $('ul.tabs').tabs('select_tab', 'global-search-follow');
            iptSearch.value = '';
            iptSearch.focus();
        });
    }
    getUserFollows();
};


//LANCEMENT ET AFFICHAGE DE LA RECERCHE
function globalSearche(searchInput) {
    let progress = document.getElementById('progressSearch'),
        findsZone = document.getElementById('global-search-finds');

    //on annule la frappe précédente
    clearTimeout(timToGlobalSearch);

    //si la recherche est la même qu'avant on ne la relance pas
    if(searchInput.value === saveSearch) return false;

    //on affiche la progresse barre
    progress.style.opacity = '1';

    //si notre champs de recherche est vide, on s'arrête (ou si on à que 2 lettres
    if(searchInput.value === '' || searchInput.value.length < 3){
        progress.style.opacity = '0';
        return false;
    }

    //on lance la fonction AJAX de recherche
    timToGlobalSearch = setTimeout(function () {
        axios.get('/API/search/10/0/' + searchInput.value).then(function (response) {

            let data = response.data;

            //sauvegarde de la recherche
            saveSearch = searchInput.value;

            //RÉSULTAT SUR LES FALAISES
            findsZone.innerHTML = response.data;

            //anime les résulats
            rideau(document.querySelectorAll('#global-search-finds .rideau-animation'));

            //séléctionne l'onglet de résultat
            $('ul.tabs').tabs('select_tab', 'global-search-finds');

            //initialise l'opener de ligne
            initRouteOpener();

            //on cache la progress barre
            progress.style.opacity = '0';
        });
    },300);
}

//ANIMATION EN RIDEAU DES RÉSULTATS DES RECHERCHES
function rideau(listes) {
    let delais = 80;

    for(let i = 0 ; i < listes.length ; i++){
        (function (i,listes,delais) {
            setTimeout(function () {
                listes[i].style.opacity = 1;
                listes[i].style.transform = 'translateY(0)';
            }, delais * i);
        })(i,listes,delais);
    }
}


//CHARGE LES FAVORIS
function getUserFollows() {
    let userId = document.getElementById('id-user-global-search'),
        followZone = document.getElementById('global-search-follow');

    if(userId.value !== "0"){
        axios.post('/follow/user', {user_id : userId.value}).then(function (response) {
            followZone.innerHTML = response.data;
        });
    }
}