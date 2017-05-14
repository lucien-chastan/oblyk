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
        if(callback !== '') callFunction(callback, window);
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