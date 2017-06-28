let loadedRouteTab = [];

//charge la structure d'une ligne
function loadRoute(id_route) {
    let route = '/vue/route/' + id_route + '/route',
        target = document.getElementById('slide-route'),
        callback = null;

    loadedRouteTab = [];

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
        });

    }
}

function reloadRouteInformationTab() {
    let route_id = document.getElementById('info-route-id');
    closeModal();
    loadTabRoute(route_id.value, 'information', 'initInformationRouteTab');
    return false;
}

function initInformationRouteTab() {

    //ajoute les événements open modal sur les boutons
    initOpenModal();

    //convertie les textes en markdown
    convertMarkdownZone();
}


function optimisePopupRoute() {
    let climbSelect = document.getElementById('select-climbs-popup-route'),
        zoneEquipement = document.getElementById('popup-route-equipement-zone'),
        typeCotation = document.getElementById('popup-route-type-cotation'),
        cotationIncline = document.getElementById('popup-route-cotation-incline'),
        nbLongueur = document.getElementById('popup-route-nb-longueur'),
        zoneBloc = document.getElementById('popup-route-bloc-zone'),
        tableLongeur = document.getElementById('popup-route-table-longueur'),
        checkTypeCotation = document.getElementById('type-cotation-longeur');

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
        tbodyTable = document.querySelectorAll('#popup-route-table-longueur tbody')[0],
        nb_longueur = document.getElementById('nb_longueur'),
        saveLine = trTable[0];

    console.log(tbodyTable);

    tbodyTable.innerHTML = '';
    console.log(tbodyTable);
    for(let i = 0 ; i < nb_longueur.value ; i++){
        console.log(i);
        tbodyTable.appendChild(saveLine);
    }
    console.log(trTable);
}