let map, markers,
    marker_0000, marker_1000, marker_0100, marker_0010, marker_0001, marker_1111,
    marker_1100, marker_0110, marker_0011, marker_1001, marker_0101, marker_1010,
    marker_1110, marker_1101, marker_1011, marker_0111,
    markerNewElement, newLat, newLng, addStarted = false, suiteIsVisible = false, addType, longToast;


//function au chargement de la map
function loadMap() {

    //définition des différents style de tuile
    let carte = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
        satellite   = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});

    map = L.map('map',{ zoomControl : false, center:[46.927527, 2.871905], zoom : 5, layers: [carte]});
    markers = L.markerClusterGroup();

    //Marker simple
    marker_0000 = L.icon({iconUrl: '/img/marker-0000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1111 = L.icon({iconUrl: '/img/marker-1111.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1000 = L.icon({iconUrl: '/img/marker-1000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0100 = L.icon({iconUrl: '/img/marker-0100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0010 = L.icon({iconUrl: '/img/marker-0010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0001 = L.icon({iconUrl: '/img/marker-0001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

    //Marker double
    marker_1100 = L.icon({iconUrl: '/img/marker-1100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0110 = L.icon({iconUrl: '/img/marker-0110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0011 = L.icon({iconUrl: '/img/marker-0011.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1001 = L.icon({iconUrl: '/img/marker-1001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0101 = L.icon({iconUrl: '/img/marker-0101.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1010 = L.icon({iconUrl: '/img/marker-1010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

    //marker triple
    marker_1110 = L.icon({iconUrl: '/img/marker-1110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1101 = L.icon({iconUrl: '/img/marker-1101.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_1011 = L.icon({iconUrl: '/img/marker-1011.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
    marker_0111 = L.icon({iconUrl: '/img/marker-0111.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

    //L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);
    L.control.zoom({position : 'bottomright'}).addTo(map);

    //création du controlleur de tuile
    let baseMaps = {
        "Relief": carte,
        "Satellite": satellite
    };

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(map);

    map.on('click', pointMarkerMap);

}


//commence la fonction ajouter un élément (crag ou sae)
function startAdd(type) {

    addType = type;

    let map = document.getElementById('map');

    map.style.cursor = 'crosshair';

    let $toastContent = (type == 'crag')? $('<span>Cliquez sur l\'emplacement du site</span>') : $('<span>Cliquez sur l\'emplacement de la salle</span>');
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

    if(addType == 'crag'){
        openModal('/modal/crag', {"lat" : newLat, "lng" : newLng, "method" : "POST", "title":"Ajouter un site", "MapReverseGeoCoding":true});
    }

    if(addType == 'sae'){

    }
}


//va chercher les données en reverse géo coding avec openstreetmap
function MapReverseGeoCoding() {
    axios.get('http://nominatim.openstreetmap.org/reverse?format=json&lat=' + newLat + '&lon=' + newLng + '&zoom=18&addressdetails=18&email=ekip@oblyk.net').then(function (response) {
        document.getElementsByName('code_country')[0].value = response.data.address.country_code;
        document.getElementsByName('country')[0].value = response.data.address.country;
        document.getElementsByName('city')[0].value = ( typeof response.data.address.village != 'undefined')? response.data.address.village : ( typeof response.data.address.city != 'undefined')? response.data.address.city : response.data.address.town;
        document.getElementsByName('region')[0].value = response.data.address.state;
    });
}

function goToNewCrag(data) {
    let cragData = JSON.parse(data.data);
    location.href = '/site-escalade/' + cragData.id + '/' + cragData.slug;
}