var currentVue,
    activeSettingsTab;


//INSCRIT LES ÉVENEMENTS SUR LES ITEMS DU MENU + CHARGE LA BONNE ROUTE
window.addEventListener('load', function () {
    let routeLink = document.getElementsByClassName('router-admin-gym-link'),
        splitLocation = location.href.split('#'),
        find = false;

    for(let i = 0 ; i < routeLink.length ; i++){
        routeLink[i].addEventListener('click', function () {loadProfileRoute(this);});
        let route = routeLink[i].getAttribute('data-route').split('/')[routeLink[i].getAttribute('data-route').split('/').length - 1];
        if(splitLocation[1] === route) {
            find = true;
            loadProfileRoute(routeLink[i]);
        }
    }

    if(!find) {
        let linkInProfile = document.querySelectorAll('.corps-de-page .router-admin-gym-link');
        loadProfileRoute(linkInProfile[0]);
    }

});


//CHARGE UNE VUE
function loadProfileRoute(element, forced = false) {
    let route = element.getAttribute('data-route'),
        target = document.getElementById('content-admin');

    console.log(route);
    console.log(target);

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

    //on change pour le dernier onglet selectionné
    $('ul.tabs').tabs('select_tab', activeSettingsTab);

    //init des inputs date
    $('.datepicker').pickadate({
        monthsFull : ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 120, // Creates a dropdown of 80 years to control year,
        today: 'Aujourd\'hui',
        min: '1900-01-01',
        max: new Date(),
        format: 'yyyy-mm-dd',
        clear: 'Annuler',
        close: 'Ok',
        closeOnSelect: true, // Close upon selecting a date,
        onSet: function (ele) {
            if(ele.select){
                this.close();
            }
        }
    });

    //initialise les selects
    $('select').material_select();

    //ajoute les événements open modal sur les boutons
    initOpenModal();

    //charge les boxes du dashboard
    try {
        //loadDashBoxs();
    }catch (e){}

    //Intialise l'opener de route
    try {
        initRouteOpener();
    }catch (e){}
}


// CACHE OU MONTRE LE LOADER DE VUE
function showUserLoader(visible) {
    let content = document.getElementById('content-admin'),
        loader = document.getElementById('load-admin-content');

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

//CHANGE L'INDICATEUR DU MENU ACTIF
function activeMenu(element) {
    let navHeadItem = document.getElementsByClassName('collapsible-header'),
        navBodyItem = document.querySelectorAll('.collapsible-body .row');

    for(let i = 0 ; i < navHeadItem.length ; i++) navHeadItem[i].setAttribute('class', navHeadItem[i].className.replace('active-item', ''))
    for(let i = 0 ; i < navBodyItem.length ; i++) navBodyItem[i].setAttribute('class', navBodyItem[i].className.replace('active-item', ''))

    element.setAttribute('class', element.className + ' active-item');
}

//RECHARGE LA VUE COURANTE
function reloadCurrentVue() {
    closeModal();
    loadProfileRoute(currentVue, true);
}