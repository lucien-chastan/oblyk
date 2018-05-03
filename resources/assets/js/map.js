var map, markers,
    markerNewElement, newLat, newLng, addStarted = false, suiteIsVisible = false, addType, longToast;

//function au chargement de la map
function loadMap() {
    let lat = 46.927527,
        lng = 2.871905,
        zoom = 5,
        dashLocation = location.href,
        splitDash = dashLocation.split('#');

    if(splitDash[1]){
        if(/^[-]?(?:\d*\.)?\d+[/][-]?(?:\d*\.)?\d+[/]\d{1,2}$/.test(splitDash[1])){
            lat = splitDash[1].split('/')[0];
            lng = splitDash[1].split('/')[1];
            zoom = splitDash[1].split('/')[2];
        }
    }

    map = L.map('map',{ zoomControl : false, center:[lat, lng], zoom : zoom, layers: [carte]});
    markers = L.markerClusterGroup();


    //POSITIONNEMENT DU CONTROLER DE ZOOM
    L.control.zoom({position : 'bottomright'}).addTo(map);


    //CONTROLER DES TUILES
    L.control.layers(baseMaps).addTo(map, {});

    // group by type of crag
    marker_group = {};
    var ll = {'type_voie': "Voie", 'type_grande_voie': "Grande Voie", 'type_bloc': "Bloc", 'type_deep_water': "Deep Water", 'type_via_ferrata': "Via Ferrata"};
    $.each(ll, function(k, v) {
        marker_group[k] = L.featureGroup.subGroup(markers, []);
        control.addOverlay(marker_group[k], v);
        marker_group[k].addTo(map);
    });

    //OUTIL DE RECHERCHE
    L.Control.geocoder(
        {
            placeholder : 'Chercher une ville ...',
            position : 'topleft',
            errorMessage : 'Aucun résulat',
            defaultMarkGeocode : false
        }
    ).on('markgeocode', function(e) {
        let bbox = e.geocode.bbox;
        let poly = L.polygon([
            bbox.getSouthEast(),
            bbox.getNorthEast(),
            bbox.getNorthWest(),
            bbox.getSouthWest()
        ], {stroke : false, fill : false }).addTo(map);
        map.fitBounds(poly.getBounds());
    }).addTo(map);


    //OUTIL DE MEUSURE
    L.Control.measureControl().addTo(map);

    map.on('click', pointMarkerMap);

    map.on('zoomend', function () {changeDash();});
    map.on('moveend', function () {changeDash();});

}

function changeDash() {
    location.replace('#' + map.getCenter().lat.toPrecision(7) + '/' + map.getCenter().lng.toPrecision(7) + '/' +  map.getZoom());
}

//commence la fonction ajouter un élément (crag ou sae)
function startAdd(type) {

    addType = type;

    let map = document.getElementById('map');

    map.style.cursor = 'crosshair';

    let $toastContent = (type === 'crag')? $('<span>Cliquez sur l\'emplacement du site</span>') : $('<span>Cliquez sur l\'emplacement de la salle</span>');
    Materialize.toast($toastContent, 3000);

    addStarted = true;

}


//change l'emplacement du marker sur la map
function pointMarkerMap(e) {

    if(addStarted){
        newLat = e['latlng']['lat'];
        newLng = e['latlng']['lng'];

        try{
            markerNewElement.setLatLng(e['latlng']);
        }catch(error) {
            markerNewElement = L.marker(e['latlng'], {}).addTo(map);
        }

        if(!suiteIsVisible){
            let $toastContent = $('<span><a onclick="openAddPopup()" class="waves-effect waves-light grey darken-3 white-text btn btn-toast-add">Ajouter<i class="material-icons right">arrow_forward</i></a></span>');
            Materialize.toast($toastContent, 100000000);
            suiteIsVisible = true;
        }
    }
}


//ouvre la popup
function openAddPopup() {

    let map = document.getElementById('map');
    map.style.cursor = 'grab';
    $('#modal').modal('open');
    $('.toast').remove();
    markerNewElement.remove();
    addStarted = false;
    suiteIsVisible = false;

    if(addType === 'crag'){
        openModal('/modal/crag', {"lat" : newLat, "lng" : newLng, "method" : "POST", "title":"Ajouter un site", "MapReverseGeoCoding":true});
    }

    if(addType === 'sae'){
        openModal('/modal/gym', {"lat" : newLat, "lng" : newLng, "method" : "POST", "title":"Ajouter une salle", "MapReverseGeoCoding":true});
    }
}


//va chercher les données en reverse géo coding avec openstreetmap
function MapReverseGeoCoding() {
    axios.get('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + newLat + '&lon=' + newLng + '&zoom=18&addressdetails=18&email=ekip@oblyk.org').then(function (response) {
        document.getElementsByName('code_country')[0].value = response.data.address.country_code;
        document.getElementsByName('country')[0].value = response.data.address.country;
        document.getElementsByName('city')[0].value = ( typeof response.data.address.village !== 'undefined')? response.data.address.village : ( typeof response.data.address.city != 'undefined')? response.data.address.city : response.data.address.town;
        document.getElementsByName('region')[0].value = response.data.address.state;
    });
}

//Envoie sur la nouvelle page du site
function goToNewCrag(data) {
    let cragData = JSON.parse(data.data);
    location.href = '/site-escalade/' + cragData.id + '/' + cragData.slug;
}

//Envoie sur la nouvelle page de la salle
function goToNewGym(data) {
    let gymData = JSON.parse(data.data);
    location.href = '/salle-escalade/' + gymData.id + '/' + gymData.slug;
}
