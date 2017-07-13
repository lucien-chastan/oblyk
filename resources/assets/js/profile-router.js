let currentVue;


//INSCRIT LES ÉVENEMENTS SUR LES ITEMS DU MENU + CHARGE LA BONNE ROUTE
window.addEventListener('load', function () {
    let routeLink = document.getElementsByClassName('router-profile-link'),
        splitLocation = location.href.split('#'),
        trouver = false;

    for(let i = 0 ; i < routeLink.length ; i++){
        routeLink[i].addEventListener('click', function () {loadProfileRoute(this);});
        let route = routeLink[i].getAttribute('data-route').split('/')[routeLink[i].getAttribute('data-route').split('/').length - 1];
        if(splitLocation[1] === route) {
            trouver = true;
            loadProfileRoute(routeLink[i]);
        }
    }

    if(!trouver) loadProfileRoute(routeLink[0]);

});


//CHARGE UNE VUE
function loadProfileRoute(element, forced = false) {
    let route = element.getAttribute('data-route'),
        target = document.getElementById('user-content');

    if(currentVue !== element || forced){
        showUserLoader(true);

        setTimeout(function () {
            axios.get(route).then(function (response) {

                //enregistre la vue courante
                currentVue = element;

                //ecrit les données
                target.innerHTML = response.data;

                //passe le hash à la page
                location.href = '#' + route.split('/')[route.split('/').length - 1];

                //faite des actions poste chargement
                afterLoad();

                activeMenu(element);

                //cache le loader
                showUserLoader(false);
            });
        },120);
    }
}


//FAIT DES ACTIONS APRÈS LE CHARGEMENT D'UNE VUE
function afterLoad() {

    //initialise les tooltips
    $('.tooltipped').tooltip({delay: 50});

    //initialise les tabs
    $('ul.tabs').tabs();

    //initialise les selects
    $('select').material_select();

    //ajoute les événements open modal sur les boutons
    initOpenModal();

    //charge les boxes du dashboard
    try {
        loadDashBoxs();
    }catch (e){}

    //Intialise l'opener de route
    try {
        initRouteOpener();
    }catch (e){}


}


// CACHE OU MONTRE LE LOADER DE VUE
function showUserLoader(visible) {
    let content = document.getElementById('user-content'),
        loader = document.getElementById('loade-user-content');

    if(visible){
        content.style.opacity = 0;
        setTimeout(function () {
            content.style.display = 'none';
            loader.style.display = 'block';
            setTimeout(function () {
                loader.style.opacity = 1;
            },10)
        },300);
    }else{
        loader.style.opacity = 0;
        setTimeout(function () {
            loader.style.display = 'none';
            content.style.display = 'block';
            setTimeout(function () {
                content.style.opacity = 1;
            },10)
        },300);
    }
}


//RECHARGE LA VUE COURANTE
function reloadCurrentVue() {
    closeModal();
    loadProfileRoute(currentVue, true);
}