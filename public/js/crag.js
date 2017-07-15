let cragMap,
    loadedSectorTab = [],
    loadedSectorId,
    cragVisionneuse;

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

            let markerIcon = styleIcon(crags[i].type_voie + '' + crags[i].type_grande_voie + '' + crags[i].type_bloc + '' + crags[i].type_deep_water + '' + crags[i].type_via_ferrata);

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

//Recharge l'onglet description qui a été mise à jour
function reloadPhotoSector(response) {
    let data = JSON.parse(response.data);
    ajaxRouter('/vue/sector/' + data.illustrable_id + '/photos', document.getElementById('photos-secteur-' + data.illustrable_id ), 'closeModalInitPhototheque');
}

function closeModalInitPhototheque() {
    closeModal();
    initSectorPhototheque();
}

//Affiche la vues d'un onglet de secteur
function loadSectorVue(tab) {

    if(!loadedSectorTab[tab.getAttribute('href')]){
        loadedSectorTab[tab.getAttribute('href')] = true;

        let route = tab.getAttribute('data-route'),
            target = document.getElementById(tab.getAttribute('href').replace('#','')),
            callback = tab.getAttribute('data-callback');

        loadedSectorId = tab.getAttribute('data-sector-id');

        ajaxRouter(route, target, callback);

    }
}

function initSectorPhototheque() {

    if(document.getElementById('sectorPhototheque-' + loadedSectorId) !== null){

        new Phototheque('#sectorPhototheque-' + loadedSectorId,
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

//INITIALISE LA VISIONNEUSE PHOTOTHEQUE
function initPhotothequeCrag() {
    cragVisionneuse = new Phototheque('#cragPhototheque',
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

function showPhotoEditor(visible) {

    if (visible){
        document.getElementById("zone-photo-editor").style.display = 'block';
        document.getElementById("zone-crag-gallerie").style.display = 'none';
        document.getElementById("bt-show-crag-gallerie-editor").style.display = 'none';
    }else{
        document.getElementById("zone-photo-editor").style.display = 'none';
        document.getElementById("zone-crag-gallerie").style.display = 'block';
        document.getElementById("bt-show-crag-gallerie-editor").style.display = 'block';
    }
}

function showPhotoSectorEditor(visible, sector_id) {

    if (visible){
        document.getElementById("zone-sector-photo-editor-" + sector_id).style.display = 'block';
        document.getElementById("zone-sector-gallerie-" + sector_id).style.display = 'none';
        document.getElementById("bt-show-sector-gallerie-editor-" + sector_id).style.display = 'none';
    }else{
        document.getElementById("zone-sector-photo-editor-" + sector_id).style.display = 'none';
        document.getElementById("zone-sector-gallerie-" + sector_id).style.display = 'block';
        document.getElementById("bt-show-sector-gallerie-editor-" + sector_id).style.display = 'block';
    }
}


function getTopoArround() {
    let lat = document.getElementById('lat-search-topo'),
        lng = document.getElementById('lng-search-topo'),
        rayon = document.getElementById('rayon-search-topo'),
        id = document.getElementById('id-search-topo'),
        zoneValidation = document.getElementById('validation-liaison-topo'),
        zoneCreerTopo = document.getElementById('zone-creer-un-nouveau-topo'),
        zoneListe = document.getElementById('zone-topo-est-il-present'),
        zoneLoader = document.getElementById('loader-liste-topo'),
        liste = document.getElementById('liste-topo-proche');

    liste.innerHTML = '';
    liste.style.display = "none";
    zoneValidation.style.display = "none";
    zoneCreerTopo.style.display = "block";
    zoneListe.style.display = "block";
    zoneLoader.style.display = "block";

    axios.get('/API/topos/' + lat.value + '/' + lng.value + '/' + rayon.value + '/' + id.value).then(function (response) {

        liste.innerHTML = response.data;

        liste.style.display = "block";
        zoneLoader.style.display = "none";

        rayon.value = parseInt(rayon.value) + 50;
    });
}


function getMassiveArround() {
    let lat = document.getElementById('lat-search-massive'),
        lng = document.getElementById('lng-search-massive'),
        rayon = document.getElementById('rayon-search-massive'),
        id = document.getElementById('id-search-massive'),
        zoneValidation = document.getElementById('validation-liaison-massive'),
        zoneCreerMassive = document.getElementById('zone-creer-un-nouveau-massive'),
        zoneListe = document.getElementById('zone-massive-est-il-present'),
        zoneLoader = document.getElementById('loader-liste-massive'),
        liste = document.getElementById('liste-massive-proche');

    liste.innerHTML = '';
    liste.style.display = "none";
    zoneValidation.style.display = "none";
    zoneCreerMassive.style.display = "block";
    zoneListe.style.display = "block";
    zoneLoader.style.display = "block";

    axios.get('/API/massives/' + lat.value + '/' + lng.value + '/' + rayon.value + '/' + id.value).then(function (response) {

        liste.innerHTML = response.data;

        liste.style.display = "block";
        zoneLoader.style.display = "none";

        rayon.value = parseInt(rayon.value) + 50;
    });
}

function selectTopo(topo_id) {
    let zoneListe = document.getElementById('zone-topo-est-il-present'),
        zoneValidation = document.getElementById('validation-liaison-topo'),
        zoneLoader = document.getElementById('loader-liste-topo'),
        zoneCreerTopo = document.getElementById('zone-creer-un-nouveau-topo'),
        nomSite = document.getElementById('nom-site-liaison'),
        rayon = document.getElementById('rayon-search-topo'),
        versTopo = document.getElementById('lien-vers-topo'),
        idLiaison = document.getElementById('id-new-liaison'),
        nomTopo = document.getElementById('nom-topo-liaison');

    zoneListe.style.display = 'none';
    zoneLoader.style.display = 'block';
    zoneCreerTopo.style.display = 'none';
    zoneValidation.style.display = 'none';

    axios.post('/topo/create-liaison',{topo_id : topo_id, crag_id : document.getElementById('id-search-topo').value}).then(function (response) {

        zoneLoader.style.display = 'none';
        zoneValidation.style.display = 'block';

        let data = response.data;

        nomSite.textContent = data.crag.label;
        nomTopo.textContent = data.topo.label;

        versTopo.href = '/topo-escalade/' + data.topo.id + '/' + data.topo.slug_label;

        rayon.value = '50';

        idLiaison.value = data.liaison.id;

    });
}

function selectMassive(massive_id) {
    let zoneListe = document.getElementById('zone-massive-est-il-present'),
        zoneValidation = document.getElementById('validation-liaison-massive'),
        zoneLoader = document.getElementById('loader-liste-massive'),
        zoneCreerMassive = document.getElementById('zone-creer-un-nouveau-massive'),
        nomSite = document.getElementById('nom-site-liaison'),
        rayon = document.getElementById('rayon-search-massive'),
        versMassive = document.getElementById('lien-vers-massive'),
        idLiaison = document.getElementById('id-new-liaison'),
        nomTopo = document.getElementById('nom-massive-liaison');

    zoneListe.style.display = 'none';
    zoneLoader.style.display = 'block';
    zoneCreerMassive.style.display = 'none';
    zoneValidation.style.display = 'none';

    axios.post('/massive/create-liaison',{massive_id : massive_id, crag_id : document.getElementById('id-search-massive').value}).then(function (response) {

        zoneLoader.style.display = 'none';
        zoneValidation.style.display = 'block';

        let data = response.data;

        nomSite.textContent = data.crag.label;
        nomTopo.textContent = data.massive.label;

        versMassive.href = '/massive-escalade/' + data.massive.id + '/' + data.massive.slug_label;

        rayon.value = '50';

        idLiaison.value = data.liaison.id;

    });
}

function deleteLiaison() {
    let idLiaison = document.getElementById('id-new-liaison'),
        zoneListe = document.getElementById('zone-topo-est-il-present'),
        zoneValidation = document.getElementById('validation-liaison-topo'),
        zoneLoader = document.getElementById('loader-liste-topo'),
        zoneCreerTopo = document.getElementById('zone-creer-un-nouveau-topo');

    zoneListe.style.display = 'none';
    zoneLoader.style.display = 'block';
    zoneCreerTopo.style.display = 'none';
    zoneValidation.style.display = 'none';

    axios.post('/topo/delete-liaison', {id : idLiaison.value}).then(function () {
        getTopoArround();
    });
}

function deleteMassiveLiaison() {
    let idLiaison = document.getElementById('id-new-liaison'),
        zoneListe = document.getElementById('zone-massive-est-il-present'),
        zoneValidation = document.getElementById('validation-liaison-massive'),
        zoneLoader = document.getElementById('loader-liste-massive'),
        zoneCreerMassive = document.getElementById('zone-creer-un-nouveau-massive');

    zoneListe.style.display = 'none';
    zoneLoader.style.display = 'block';
    zoneCreerMassive.style.display = 'none';
    zoneValidation.style.display = 'none';

    axios.post('/massive/delete-liaison', {id : idLiaison.value}).then(function () {
        getMassiveArround();
    });
}


function goToNewTopo(response) {
    let data = JSON.parse(response.data);
    window.location.href = '/topo-escalade/' + data.id + '/' + data.slug_label;
}

function goToNewMassive(response) {
    let data = JSON.parse(response.data);
    window.location.href = '/sites-escalade/' + data.id + '/' + data.slug_label;
}

function uploadTopoPdf(form, callback) {
    let route = form.getAttribute('data-route'),
        inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-topo').files[0]);

    //ajout les autres données à passage de la form
    for(let i in inputData){
        if(typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            document.getElementById('progressbar-upload-topo').style.width = percentCompleted + '%';
        }
    };

    axios.post(route, data, config).then(
        function (response) {
            closeModal();
            callback(response);
        }
    ).catch(
        function (err) {
            console.log(err.message);
            showSubmitLoader(false);
        }
    );
}

function getCragPosts(){
    getPosts('Crag',document.getElementById('id-crag-actualite').value, document.getElementById('insert-posts-zone'));
}