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
        nbCrag = document.getElementById('nb-result-global-search-crag'),
        nbRoute = document.getElementById('nb-result-global-search-route'),
        nbTopo = document.getElementById('nb-result-global-search-topo'),
        nbUser = document.getElementById('nb-result-global-search-user'),
        nbLexique = document.getElementById('nb-result-global-search-lexique'),
        nbAide = document.getElementById('nb-result-global-search-aide'),
        cragZone = document.getElementById('global-search-crag'),
        lexiqueZone = document.getElementById('global-search-lexique'),
        routeZone = document.getElementById('global-search-route'),
        topoZone = document.getElementById('global-search-topo'),
        userZone = document.getElementById('global-search-user'),
        aideZone = document.getElementById('global-search-aide');

    //on annule la frappe précédente
    clearTimeout(timToGlobalSearch);

    //si la recherche est la même qu'avant on ne la relance pas
    if(searchInput.value === saveSearch) return false;

    //on affiche la progresse barre
    progress.style.opacity = '1';

    //on fait disparaitre les étiquettes de nombres
    scaleTransition(nbCrag, 'out');
    scaleTransition(nbRoute, 'out');
    scaleTransition(nbTopo, 'out');
    scaleTransition(nbUser, 'out');
    scaleTransition(nbLexique, 'out');
    scaleTransition(nbAide, 'out');

    //si notre champs de recherche est vide, on s'arrête
    if(searchInput.value === ''){
        progress.style.opacity = '0';
        return false;
    }

    //on lance la fonction AJAX de recherche
    timToGlobalSearch = setTimeout(function () {
        axios.get('/API/search/' + searchInput.value).then(function (response) {

            let data = response.data;

            //sauvegarde de la reche
            saveSearch = data.search;

            //on inscrit le nombre de résultat
            nbCrag.textContent = data.nombre.crags + data.nombre.massives;
            nbRoute.textContent = data.nombre.routes;
            nbTopo.textContent = data.nombre.topos + data.nombre.topoPdfs + data.nombre.topoWebs;
            nbUser.textContent = data.nombre.users;
            nbLexique.textContent = data.nombre.words;
            nbAide.textContent = data.nombre.aides;


            //RÉSULTAT SUR LES FALAISES
            cragZone.innerHTML = '';
            if(data.nombre.crags > 0 || data.nombre.massives > 0){
                scaleTransition(nbCrag, 'in');

                //les massifs d'abord
                for(let i = 0 ; i < data.nombre.massives ; i++) {
                    cragZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left circle" src="/img/icon-search-massive.svg"><a href="${data.massives[i].url}">${data.massives[i].label}</a><br><span class="grey-text">Regroupement de ${data.massives[i].crags_count} sites)</span></div>`;
                }

                //les falaises ensuite
                for(let i = 0 ; i < data.nombre.crags ; i++) {
                    cragZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left circle" src="${data.crags[i].bandeau}"><a href="${data.crags[i].url}"><img src="/img/point-${data.crags[i].climbType}.svg" class="search-climb-type">  ${data.crags[i].label}</a><br><span class="grey-text">${data.crags[i].region} (${data.crags[i].code_country})</span></div>`;
                }
                rideau(document.querySelectorAll('#global-search-crag .rideau-animation'));
            }else{
                cragZone.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans les falaises</p>`
            }


            //RÉSULTAT SUR LES ROUTES
            routeZone.innerHTML = '';
            if(data.nombre.routes > 0){
                scaleTransition(nbRoute, 'in');
                for(let i = 0 ; i < data.nombre.routes ; i++) {
                    routeZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left circle" src="${data.routes[i].bandeau}"><a class="button-open-route text-cursor" class="button-open-route" onclick="loadRoute(${data.routes[i].id})"><img src="/img/climb-${data.routes[i].climb_id}.png" class="search-climb-type"> <span class="color-grade-${data.routes[i].color} text-normal">${data.routes[i].cotation}</span> ${data.routes[i].label}</a><br><span class="grey-text">sur le site <a href="${data.routes[i].cragUrl}">${data.routes[i].crag.label}</a>, ${data.routes[i].crag.region} (${data.routes[i].crag.code_country})</span></div>`;
                }
                rideau(document.querySelectorAll('#global-search-route .rideau-animation'));
                initRouteOpener();
            }else{
                routeZone.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans les lignes</p>`
            }


            //RÉSULTAT SUR LES TOPOS
            topoZone.innerHTML = '';
            if(data.nombre.topos > 0 || data.nombre.topoPdfs > 0 || data.nombre.topoWebs > 0){
                scaleTransition(nbTopo, 'in');

                //TOPO PAPIER
                if(data.nombre.topos > 0){
                    for(let i = 0 ; i < data.nombre.topos ; i++) {
                        topoZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left couverture-topo" src="${data.topos[i].couverture}"><a href="${data.topos[i].url}">${data.topos[i].label}</a><br><span class="grey-text">${data.topos[i].author}, ${data.topos[i].editor} ${data.topos[i].editionYear}</span></div>`;
                    }
                }

                //TOPO PDF
                if(data.nombre.topoPdfs > 0){
                    for(let i = 0 ; i < data.nombre.topoPdfs ; i++) {
                        topoZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left couverture-topo" src="${data.topoPdfs[i].couverture}"><a href="${data.topoPdfs[i].url}">${data.topoPdfs[i].label}</a><br><span class="grey-text">sur le site : <a href="${data.topoPdfs[i].cragUrl}">${data.topoPdfs[i].crag.label}</a></span></div>`;
                    }
                }

                //TOPO WEB
                if(data.nombre.topoWebs > 0){
                    for(let i = 0 ; i < data.nombre.topoWebs ; i++) {
                        topoZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left couverture-topo" src="${data.topoWebs[i].couverture}"><a href="${data.topoWebs[i].url}">${data.topoWebs[i].label}</a><br><span class="grey-text">sur le site : <a href="${data.topoWebs[i].cragUrl}">${data.topoWebs[i].crag.label}</a></span></div>`;
                    }
                }

                rideau(document.querySelectorAll('#global-search-topo .rideau-animation'));
            }else{
                topoZone.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans les topos</p>`
            }



            //RÉSULTAT SUR LES GRIMPEURS
            userZone.innerHTML = '';
            if(data.nombre.users > 0){
                scaleTransition(nbUser, 'in');
                for(let i = 0 ; i < data.nombre.users ; i++) {
                    userZone.innerHTML += `<div class="col s12 blue-border-search crag-result rideau-animation"><img class="left circle" src="${data.users[i].photo}"><a href="${data.users[i].url}">${data.users[i].name}</a><br><span class="grey-text">information</span></div>`;
                }
                rideau(document.querySelectorAll('#global-search-user .rideau-animation'));
            }else{
                userZone.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans les grimpeurs</p>`
            }


            //RÉSULTAT SUR LE LEXIQUE
            lexiqueZone.innerHTML = '';
            if(data.nombre.words > 0){
                scaleTransition(nbLexique, 'in');
                for(let i = 0 ; i < data.nombre.words ; i++){
                    lexiqueZone.innerHTML += `<div class="blue-border-search rideau-animation"><strong>${data.words[i].label}</strong><br>${data.words[i].definition}</div>`;
                }
                lexiqueZone.innerHTML += '<div class="rideau-animation"><p class="text-right">voir le <a href="/lexique">lexique</a></p></div>';
                rideau(document.querySelectorAll('#global-search-lexique .rideau-animation'));
            }else{
                lexiqueZone.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans le lexique</p>`;
            }

            //RÉSULTAT SUR L'AIDE
            aideZone.innerHTML = '';
            if(data.nombre.aides > 0){
                scaleTransition(nbAide, 'in');
                for(let i = 0 ; i < data.nombre.aides ; i++){
                    aideZone.innerHTML += `<div class="blue-border-search rideau-animation"><strong>${data.aides[i].label}</strong><div class="markdownZone">${data.aides[i].contents}</div></div>`;
                }
                aideZone.innerHTML += '<div class="rideau-animation"><p class="text-right">voir <a href="/aides">l\'aide</a></p></div>';
                rideau(document.querySelectorAll('#global-search-aide .rideau-animation'));
            }else{
                aideZone.innerHTML = `<p class="text-center grey-text">il n\'y a pas de résultat pour : "${data.search}" dans l'aide</p>`;
            }


            //On compil les markdowns si nous avons des résultats sur le lexique ou sur l'aide
            if(data.nombre.aides > 0 || data.nombre.words > 0){
                convertMarkdownZone();
            }

            //CHAGEMENT D'ONGLET AU MIEUX
            changeTab(data);

            //on cache la progress barre
            progress.style.opacity = '0';
        });
    },500);
}


//FONCTION D'ANIMATION DES ÉTIQUETTES DE NOMBRE
function scaleTransition(ettiquette, scale) {
    let invertScale = (scale === 'in') ? 'out' : 'in';
    ettiquette.setAttribute('class', ettiquette.className.replace('scale-' + invertScale, 'scale-' + scale));
}


//OPTIMISE L'ONGLET SÉLÉCTIONNÉ
function changeTab(data) {
    let tabs = document.getElementsByClassName('tab-global-search'),
        activeTab,
        trouver = false;

    // Recherche de la tab active
    for(let i = 0 ; i < tabs.length ; i++) if(tabs[i].className.search('active') !== -1) activeTab = tabs[i];

    //si la tab active à des résultats alors on reste sur celle-ci
    if(activeTab.id === 'tab-global-search-crag' && (data.nombre.crags > 0 || data.nombre.massives > 0)) return false;
    if(activeTab.id === 'tab-global-search-route' && data.nombre.routes > 0) return false;
    if(activeTab.id === 'tab-global-search-topo' && (data.nombre.topos > 0 || data.nombre.topoPdfs > 0 || data.nombre.topoWebs > 0)) return false;
    if(activeTab.id === 'tab-global-search-user' && data.nombre.users > 0) return false;
    if(activeTab.id === 'tab-global-search-lexique' && data.nombre.words > 0) return false;
    if(activeTab.id === 'tab-global-search-aide' && data.nombre.aides > 0) return false;


    // Si l'onglet actif n'a pas de résultat on cherche le meilleur onglet
    if(data.nombre.crags > 0 || data.nombre.massives > 0) {
        $('ul.tabs').tabs('select_tab', 'global-search-crag');
    } else if (data.nombre.routes > 0) {
        $('ul.tabs').tabs('select_tab', 'global-search-route');
    } else if (data.nombre.topos > 0 || data.nombre.topoPdfs > 0 || data.nombre.topoWebs > 0) {
        $('ul.tabs').tabs('select_tab', 'global-search-topo');
    } else if (data.nombre.users > 0) {
        $('ul.tabs').tabs('select_tab', 'global-search-user');
    } else if (data.nombre.words > 0) {
        $('ul.tabs').tabs('select_tab', 'global-search-lexique');
    } else if (data.nombre.aides > 0) {
        $('ul.tabs').tabs('select_tab', 'global-search-aide');
    }

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

            let data = response.data;

            followZone.innerHTML = '';
            for(let i = 0 ; i < data.follows.length ; i++){
                followZone.innerHTML += `<div class="col s12 blue-border-search crag-result"><img class="left circle" src="${data.follows[i].followIcon}"><a href="${data.follows[i].followUrl}">${data.follows[i].followName}</a><br><span class="grey-text">${data.follows[i].followInformation}</span></div>`;
            }

        });
    }
}