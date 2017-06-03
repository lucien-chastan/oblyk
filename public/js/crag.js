let cragMap,
    loadedSectorTab = [];

function initCragMap() {
    let map = document.getElementById('crag-map'),
        latCenter = parseFloat(document.getElementById('cragLat').value),
        lngCenter = parseFloat(document.getElementById('cragLng').value),
        rayon = 15; //rayon en km

    cragMap = L.map('crag-map',{ zoomControl : true, center:[latCenter, lngCenter], zoom : 16, layers: [carte]});

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(cragMap);

    //ajout du cercle de limite de ce qui est affiché sur cette carte
    L.circle([latCenter, lngCenter], {radius: rayon * 1000 , fill:false, weight : 1, color : '#E33213', dashArray : 10}).addTo(cragMap);

    axios.get('/API/crags/' + latCenter + '/' + lngCenter + '/' + rayon).then(function (response) {
        let crags = response.data.crags;

        //ajoute les markeurs à la carte
        for(let i in crags){

            let markerIcon = styleIcon(crags[i].type_voie + '' + crags[i].type_grande_voie + '' + crags[i].type_bloc + '' + crags[i].type_deep_water);

            L.marker(
                [crags[i].lat,crags[i].lng],
                {icon: markerIcon}
            ).bindPopup(buildPopup(crags[i])).addTo(cragMap);

            if(crags[i].id == document.getElementById('cragId').value){
                for(let j in crags[i].parkings){
                    L.marker(
                        [crags[i].parkings[j].lat,crags[i].parkings[j].lng],
                        {icon: marker_parking}
                    ).bindPopup(`
                        <div class="crag-leaflet-info parking-leaflet-info">
                            <h2 class="loved-king-font titre-crag-leaflet"> Parking </h2>
                            <div>${crags[i].parkings[j].description}</div>
                        </div>
                    `).addTo(cragMap);
                }
            }
        }
    });
}

//recharge l'onglet des secteurs quand on le met à jour par exemple
function reloadSector(response) {
    let data = JSON.parse(response.data);
    ajaxRouter('/vue/crag/' + data.id + '/secteur', document.getElementById('voies'), 'closeModal');
}

//Recharge l'onglet description qui a été mise à jour
function reloadDescriptionSector(response) {
    let data = JSON.parse(response.data);
    ajaxRouter('/vue/sector/' + data.descriptive_id + '/descriptions', document.getElementById('description-secteur-' + data.descriptive_id ), 'closeModal');
}

//Affiche la vues d'un onglet de secteur
function loadSectorVue(tab) {


    if(!loadedSectorTab[tab.getAttribute('href')]){
        loadedSectorTab[tab.getAttribute('href')] = true;

        let route = tab.getAttribute('data-route'),
            target = document.getElementById(tab.getAttribute('href').replace('#','')),
            callback = tab.getAttribute('data-callback');

        console.log(route);

        ajaxRouter(route, target, callback);

    }
}

function changeAffichageSecteur(typeAffichage) {
    let secteurDiv = document.getElementsByClassName('div-secteur'),
        btLarge = document.getElementById('btnLargeAffichage'),
        btCondense = document.getElementById('btnCondenseAffichage');

    for(let i = 0 ; i < secteurDiv.length ; i++) {
        if(typeAffichage === 'condense') {
            secteurDiv[i].style.maxHeight = '70px';
            secteurDiv[i].style.overflowY = 'hidden';
            btLarge.setAttribute('class', btLarge.className.replace('blue-text','grey-text'));
            btCondense.setAttribute('class', btCondense.className.replace('grey-text','blue-text'));
        }else{
            secteurDiv[i].style.maxHeight = '';
            secteurDiv[i].style.overflowY = 'auto';
            btCondense.setAttribute('class', btCondense.className.replace('blue-text','grey-text'));
            btLarge.setAttribute('class', btLarge.className.replace('grey-text','blue-text'));
        }
    }
}

function extendSectorDiv(sectorId) {
    let secteurDiv = document.getElementById('div-secteur-' + sectorId);

    secteurDiv.style.maxHeight = '';
    secteurDiv.style.overflowY = 'auto';
}


//VA CHERCHER LES DONNÉES DES GRAPHIQUES ET LES AFFICHES
function getGraphCrag(crag_id) {

    //Graphique des cotations
    axios.get('/chart/crag/' + crag_id + '/grade').then(function (response) {
        let chart = new Chart(document.getElementById("gradeGraph").getContext('2d'),JSON.parse(response.data));
    });

    //Graphique des type de grimpe
    axios.get('/chart/crag/' + crag_id + '/climb').then(function (response) {
        let chart = new Chart(document.getElementById("climbGraph").getContext('2d'),JSON.parse(response.data));
    });
}

//VA CHERCHER LES DONNÉES DES GRAPHS SECTOR À AFFICHER
function getSectorChart() {
    let sectors = document.getElementsByClassName('sector-graph-canvas');

    for(let i = 0 ; i < sectors.length ; i++){
        let sectorId = sectors[i].getAttribute('data-sector-id');
        axios.get('/chart/sector/' + sectorId + '/grade').then(function (response) {
            let chart = new Chart(document.getElementById("gradeSectorGraph-" + sectorId).getContext('2d'),JSON.parse(response.data));
        });
    }
}