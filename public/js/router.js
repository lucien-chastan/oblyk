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

            //on note comme quoi on charge l'onglet
            loadedTab[routerTab[i].getAttribute('href')] = true;

            //définition des paramètres de l'onglet
            let route = routerTab[i].getAttribute('data-route'),
                target = document.getElementById(splitLocation[1]),
                callback = routerTab[i].getAttribute('data-callback');

            //chargement du contenu de la page
            ajaxRouter(route, target, callback);

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
            target = document.getElementById(tab.getAttribute('href').replace('#','')),
            callback = tab.getAttribute('data-callback');

        ajaxRouter(route,target, callback);

    }
}

//FONCTION QUI CHARGE LE CONTENU DE L'ONGLET CIBLE
function ajaxRouter(route, target, callback) {
    axios.get(route).then(function (response) {
        target.innerHTML = response.data;

        //exécute le call back s'il y en a un
        if(callback !== null) callFunction(callback, window);

        //ajoute les événements open modal sur les boutons
        initOpenModal();

        //convertie les textes en markdown
        convertMarkdownZone();

        //initialise les tooltip
        $('.tooltipped').tooltip({delay: 50});

        //initialise les tabs
        setTimeout(function () {
            $('ul.tabs').tabs();
        },300);

        //initialisation des boutons pour ouvrir la zone d'affichage d'une ligne
        $(".button-open-route").sideNav({
            menuWidth: 500,
            edge: 'right',
            closeOnClick: false,
            draggable: false
        });
    });
}

//APPEL UNE FUNCTION PAR SON NOM EN STRING
function callFunction(functionName, context /*, args */) {
    let args = [].slice.call(arguments).splice(2),
        namespaces = functionName.split("."),
        func = namespaces.pop();
    for(let i = 0; i < namespaces.length; i++) {
        context = context[namespaces[i]];
    }
    return context[func].apply(context, args);
}