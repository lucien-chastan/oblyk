let loadedRouteTab = [],
    timeToGetSimilar;

function initRouteOpener() {
    let btns = document.getElementsByClassName('button-open-route');

    for(let i = 0 ; i < btns.length ; i++){
        if(btns[i].getAttribute('data-parsed') !== 'true'){
            btns[i].setAttribute('data-parsed', 'true');
            btns[i].addEventListener('click', openSideRoute);
        }
    }
}

function openSideRoute(opened = true) {
    let overlay = document.getElementById('overlay-side-route'),
        side = document.getElementById('slide-route');

    if(opened){
        overlay.style.display = 'block';
        setTimeout(function () {
            side.style.transform = 'translateX(0)';
            overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
        },10);
    }else{
        overlay.style.backgroundColor = 'rgba(0,0,0,0)';
        side.style.transform = 'translateX(100%)';
        setTimeout(function () {
            overlay.style.display = 'none';
        },300);
    }
}


//charge la structure d'une ligne
function loadRoute(id_route, load_tab = false) {
    let route = '/vue/route/' + id_route + '/route',
        target = document.getElementById('slide-route'),
        callback = null;

    loadedRouteTab = [];

    if(load_tab !== false){
        if(load_tab === 'carnet') callback = 'reloadRouteCarnetTab';
    }

    ajaxRouter(route, target, callback);
}

//charge un onglet
function loadTabRoute(id_route, tab, callback) {
    if(!loadedRouteTab[tab]){
        loadedRouteTab[tab] = true;

        let route = '/vue/route/' + id_route + '/' + tab,
            target = document.getElementById('route-tab-' + tab);

        axios.get(route).then(function (response) {
            target.innerHTML = response.data;
            if(callback !== null) callFunction(callback, window);

            //ajoute les événements open modal sur les boutons
            initOpenModal();

            //convertie les textes en markdown
            convertMarkdownZone();

            //initialise les tooltip
            $('.tooltipped').tooltip({delay: 50});

        });

    }
}

function reloadRouteInformationTab() {
    let route_id = document.getElementById('info-route-id');

    loadedRouteTab['information'] = false;

    closeModal();
    loadTabRoute(route_id.value, 'information', 'initInformationRouteTab');
    return false;
}

function reloadRouteVideoTab() {
    let route_id = document.getElementById('info-route-id');

    loadedRouteTab['videos'] = false;

    closeModal();
    loadTabRoute(route_id.value, 'videos', 'initVideoRouteTab');
    return false;
}

function reloadRoutePhotoTab() {
    let route_id = document.getElementById('info-route-id');

    loadedRouteTab['photos'] = false;

    closeModal();
    loadTabRoute(route_id.value, 'photos', 'initRoutePhototheque');
    return false;
}


function reloadRouteCarnetTab() {
    let route_id = document.getElementById('info-route-id');

    loadedRouteTab['carnet'] = false;

    closeModal();
    loadTabRoute(route_id.value, 'carnet', 'initCarnetRouteTab');
    return false;
}

function initInformationRouteTab() {

    //ajoute les événements open modal sur les boutons
    initOpenModal();

    //convertie les textes en markdown
    convertMarkdownZone();
}

function initVideoRouteTab() {
    //ajoute les événements open modal sur les boutons
    initOpenModal();
}

function initCarnetRouteTab() {
    //ajoute les événements open modal sur les boutons
    initOpenModal();

    console.log('ok');
    $('ul.tabs').tabs('select_tab', 'route-tab-carnet');
}

function initRoutePhototheque() {

    if(document.getElementById('routePhototheque') !== null){

        new Phototheque('#routePhototheque',
            {
                "maxHeight" : "150px","gouttiere" : "3px",
                "lastRow" : "center",
                "visiotheque" : true,
                "visiotheque-option" : {
                    "legende" : "data-legende"
                }
            }
        );
    }

    initOpenModal();

}


function optimisePopupRoute() {
    let climbSelect = document.getElementById('select-climbs-popup-route'),
        zoneEquipement = document.getElementById('popup-route-equipement-zone'),
        typeCotation = document.getElementById('popup-route-type-cotation'),
        cotationIncline = document.getElementById('popup-route-cotation-incline'),
        nbLongueur = document.getElementById('popup-route-nb-longueur'),
        zoneBloc = document.getElementById('popup-route-bloc-zone'),
        tableLongeur = document.getElementById('popup-route-table-longueur'),
        checkTypeCotation = document.getElementById('type_cotation_longeur');

    //Type bloc
    if(climbSelect.value === '2'){
        zoneEquipement.style.display = 'none';
        cotationIncline.style.display = 'block';
        typeCotation.style.display = 'none';
        nbLongueur.style.display = 'none';
        tableLongeur.style.display = 'none';
        zoneBloc.style.display = 'block';
    }

    //Type voie
    if(climbSelect.value === '3'){
        zoneEquipement.style.display = 'block';
        cotationIncline.style.display = 'block';
        typeCotation.style.display = 'none';
        nbLongueur.style.display = 'none';
        tableLongeur.style.display = 'none';
        zoneBloc.style.display = 'none';
    }

    //Type grande-voie
    if(climbSelect.value === '4'){
        typeCotation.style.display = 'block';
        nbLongueur.style.display = 'block';
        zoneBloc.style.display = 'none';
        if(checkTypeCotation.checked === true){
            cotationIncline.style.display = 'none';
            zoneEquipement.style.display = 'none';
            tableLongeur.style.display = 'block';
        }else{
            cotationIncline.style.display = 'block';
            zoneEquipement.style.display = 'block';
            tableLongeur.style.display = 'none';
        }
    }

    //Type trad
    if(climbSelect.value === '5'){
        typeCotation.style.display = 'block';
        nbLongueur.style.display = 'block';
        zoneBloc.style.display = 'none';
        if(checkTypeCotation.checked === true){
            cotationIncline.style.display = 'none';
            zoneEquipement.style.display = 'none';
            tableLongeur.style.display = 'block';
        }else{
            cotationIncline.style.display = 'block';
            zoneEquipement.style.display = 'block';
            tableLongeur.style.display = 'none';
        }
    }

    //Type artif
    if(climbSelect.value === '6'){
        nbLongueur.style.display = 'block';
        zoneBloc.style.display = 'none';
        if(checkTypeCotation.checked === true){
            cotationIncline.style.display = 'none';
            zoneEquipement.style.display = 'none';
            tableLongeur.style.display = 'block';
        }else{
            cotationIncline.style.display = 'block';
            zoneEquipement.style.display = 'block';
            tableLongeur.style.display = 'none';
        }
    }

    //Type deep-water
    if(climbSelect.value === '7'){
        zoneEquipement.style.display = 'none';
        cotationIncline.style.display = 'block';
        nbLongueur.style.display = 'none';
        typeCotation.style.display = 'none';
        tableLongeur.style.display = 'none';
        zoneBloc.style.display = 'none';
    }

    //Type via-ferrata
    if(climbSelect.value === '8'){
        zoneEquipement.style.display = 'none';
        cotationIncline.style.display = 'block';
        nbLongueur.style.display = 'none';
        typeCotation.style.display = 'none';
        tableLongeur.style.display = 'none';
        zoneBloc.style.display = 'none';
    }

}

function dupliqueLongueurLine() {
    let trTable = document.querySelectorAll('#popup-route-table-longueur tbody tr'),
        tbodyTable = document.getElementById('tbody-liste-longueur'),
        nb_longueur = document.getElementById('nb_longueur'),
        saveLine = '';

    if(nb_longueur.value >= 1){
        $('#tbody-liste-longueur select').material_select('destroy');
        saveLine = trTable[0].innerHTML;
        tbodyTable.innerHTML = '';
        for(let i = 0 ; i < nb_longueur.value ; i++){
            tbodyTable.innerHTML += saveLine.replace('L.1','L.' + (i + 1));
        }
    }

    getJsonLongueur();

    //réinitialise les selects
    $('select').material_select();
}

function setJsonLongueur() {
    let cotation_longueur = document.getElementsByName('cotation_longueur'),
        ponderation_longueur = document.getElementsByName('ponderation_longueur'),
        relais_longueur = document.getElementsByName('relais_longueur'),
        point_longueur = document.getElementsByName('point_longueur'),
        nb_point_longueur = document.getElementsByName('nb_point_longueur'),
        incline_id_longeur = document.getElementsByName('incline_id_longeur'),
        height_longueur = document.getElementsByName('height_longueur'),
        jsonLongueur = document.getElementById('jsonLongueur'),
        tableJson = [];

    for(let i = 0 ; i < cotation_longueur.length ; i++){
        let tempTab = [
            cotation_longueur[i].value,
            ponderation_longueur[i].value,
            relais_longueur[i].value,
            point_longueur[i].value,
            nb_point_longueur[i].value,
            incline_id_longeur[i].value,
            height_longueur[i].value
        ];
        tableJson.push(tempTab.join(';'));
    }

    jsonLongueur.value = tableJson.join('||');

}

function getJsonLongueur() {
    let cotation_longueur = document.getElementsByName('cotation_longueur'),
        ponderation_longueur = document.getElementsByName('ponderation_longueur'),
        relais_longueur = document.getElementsByName('relais_longueur'),
        point_longueur = document.getElementsByName('point_longueur'),
        nb_point_longueur = document.getElementsByName('nb_point_longueur'),
        incline_id_longeur = document.getElementsByName('incline_id_longeur'),
        height_longueur = document.getElementsByName('height_longueur'),
        jsonLongueur = document.getElementById('jsonLongueur'),
        tableJson = jsonLongueur.value.split('||');

    for(let i = 0 ; i < tableJson.length ; i++){
        let tempTab = tableJson[i].split(';');
        try {
            cotation_longueur[i].value = tempTab[0];
            ponderation_longueur[i].value = tempTab[1];
            relais_longueur[i].value = tempTab[2];
            point_longueur[i].value = tempTab[3];
            nb_point_longueur[i].value = tempTab[4];
            incline_id_longeur[i].value = tempTab[5];
            height_longueur[i].value = tempTab[6];
        }catch (e){}
    }
}

function prepareNewLine(response) {
    let popup_line_name = document.getElementById('popup_line_name');

    showSubmitLoader(false);

    let data = JSON.parse(response.data);

    //recharge la liste des lignes en arrière fond
    if(document.getElementById('voies-secteur-' + data.sector_id) !== 'undefined'){
        axios.get('/vue/sector/' + data.sector_id + '/lines').then(function (response) {
            document.getElementById('voies-secteur-' + data.sector_id).innerHTML = response.data;
        });
    }

    Materialize.toast('<p>' + popup_line_name.value + ' ajouté</p>', 10000);
    $(".button-collapse").sideNav();

    popup_line_name.value = '';
    popup_line_name.focus();
}


function getSimilarRoute() {
    clearTimeout(timeToGetSimilar);
    let errorPopupText = document.getElementById('errorPopupText'),
        label = document.getElementById('popup_line_name');

    if(label.value.length > 3){
        timeToGetSimilar = setTimeout(function () {
            axios.post('/similar/route', {
                crag_id : document.getElementById('crag_id').value,
                route_id : document.getElementById('popup_id_ligne').value,
                label : label.value
            }).then(function (response) {

                let data = JSON.parse(response.data);

                if(data !== '' ){
                    errorPopupText.style.display = 'block';
                    errorPopupText.innerHTML = 'Attention ! une ligne s\'appelle : ' + response.data;
                }else{
                    errorPopupText.style.display = 'none';
                }
            });
        }, 300);
    }
}

function showRoutePhotoEditor(visible) {
    if (visible){
        document.getElementById("zone-route-photo-editor").style.display = 'block';
        document.getElementById("zone-route-gallerie").style.display = 'none';
        document.getElementById("bt-show-route-gallerie-editor").style.display = 'none';
    }else{
        document.getElementById("zone-route-photo-editor").style.display = 'none';
        document.getElementById("zone-route-gallerie").style.display = 'block';
        document.getElementById("bt-show-route-gallerie-editor").style.display = 'block';
    }
}

function addInTickList(route_id) {
    axios.post('/tick-list/add',{route_id:route_id}).then(function (response) {
        let data = response.data;

        Materialize.toast(data.label + ' à été ajoutée à ma ticklist', 4000);
        reloadRouteCarnetTab();
    })
}

function parsePitch() {
    let checkPitch = document.getElementsByName('crossPopupPitch'),
        crossPitchs = document.getElementById('crossPitchs'),
        arrayCrossPitchs = [];

    for(let i = 0 ; i < checkPitch.length ; i++){
        if(checkPitch[i].checked === true){
            arrayCrossPitchs.push(checkPitch[i].value);
        }
    }

    crossPitchs.value = arrayCrossPitchs.join(';');
}


function parseFreinds() {
    let checkFriend = document.getElementsByName('check_freind_cross_users'),
        crossFriends = document.getElementById('crossFriends'),
        arrayCrossFriends = [];

    for(let i = 0 ; i < checkFriend.length ; i++){
        if(checkFriend[i].checked === true){
            arrayCrossFriends.push(checkFriend[i].value);
        }
    }

    crossFriends.value = arrayCrossFriends.join(';');
}