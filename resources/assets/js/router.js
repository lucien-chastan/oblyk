let loadedTab = [];

//LIE LES ONCLICKS SUR LES LIENS QUI MÈNE AUX VUES
window.addEventListener('load', function () {
    let routerTab = document.getElementsByClassName('router-link'),
        splitLocation = location.href.split('#');

    for(let i = 0 ; i < routerTab.length ; i++){
        loadedTab[routerTab[i].getAttribute('href')] = false;
        routerTab[i].addEventListener('click', loadTab);

        //Si jamais le Hash est égale à l'élément du menu que l'on parcours, alors on charge l'onglet
        if(routerTab[i].getAttribute('href') === ('#' + splitLocation[1])) {

            let route = routerTab[i].getAttribute('data-route'),
                target = document.getElementById(splitLocation[1]);

            //chargement du contenu de la page
            ajaxRouter(route,target);

            //scoll de la page à zero
            window.scrollTo(0,0);
        }
    }

});

//CHARGE LE CONTENU DE LA VUE DANS L'ONGLET CORRESPONDANT
function loadTab() {
    let tab = this;
    location.href = tab.href;

    if(!loadedTab[tab.getAttribute('href')]){
        loadedTab[tab.getAttribute('href')] = true;

        let route = tab.getAttribute('data-route'),
            target = document.getElementById(tab.getAttribute('href').replace('#',''));

        ajaxRouter(route,target);

    }
}

//FONCTION QUI CHARGE LE CONTENU DE L'ONGLET CIBLE
function ajaxRouter(route, target) {
    axios.get(route).then(function (response) {target.innerHTML = response.data;});
}