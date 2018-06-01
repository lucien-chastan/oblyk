var map, markers, gym_markers,
    markerNewElement, newLat, newLng, addStarted = false, suiteIsVisible = false, addType, longToast;

var slider = document.getElementById('grades-slider');
var progress_bar = document.getElementById('progress_bar');

let search_box_loaded = false;

function searchCragsOnMap() {
    progress_bar.style.display = "block";
    var types = document.getElementsByName('voie_type');
    var query = "/API/crags/search?";
    for (var i = 0; i < types.length; i++) {
        var t = types[i];
        if (t.checked === true)  {
            query += "climb_type[]=" + t.value + "&";
        }
    }
    var ranges = slider.noUiSlider.get();
    query += "range_from=" + ranges[0] + "&range_to=" + ranges[1];

    getCragsList(query);
}

function getCragsList(query) {
    var i, point;
    axios.get(query).then(function(data) {
        markers.clearLayers();
        for (i = 0; i < data.data.data.crags.length; i++) {
            point = make_crag_point(data.data.data.crags[i]);
            markers.addLayer(point);
        }

        console.log(data.data.data.gyms.length);

        for (i = 0; i < data.data.data.gyms.length; i++) {
            point = make_gym_point(data.data.data.gyms[i]);
            markers.addLayer(point);
        }

        map.addLayer(markers);
        progress_bar.style.display = "none";
    });
}

function make_crag_point(crag) {
    var point = L.marker(
        [crag.lat, crag.lng],
        {icon: styleIcon("" + crag.type_voie + crag.type_grande_voie + crag.type_bloc + crag.type_deep_water + crag.type_via_ferrata + "")}
    ).bindPopup(buildPopup(crag));
    return point;
}

function make_gym_point(gym) {
    var point = L.marker(
        [gym.lat, gym.lng],
        {icon: styleGymIcon("" + gym.type_boulder + gym.type_route + "")}
    ).bindPopup(buildGymPopup(gym));
    return point;
}

function hideSearchCrags() {
    volet = document.getElementById('my-user-circle-partner');
    volet.style.transform = 'translateX(-100%)';
}


let labels_rev = {};
var min_r_label = document.getElementById('min_range');
var max_r_label = document.getElementById('max_range');

function onUp(v) {
    min_r_label.innerHTML = v[0];
    min_r_label.className = "color-grade-"+labels_rev[v[0]];
    max_r_label.innerHTML = v[1];
    max_r_label.className = "color-grade-"+labels_rev[v[1]];
}

function createSearchBox() {
    if (!search_box_loaded) {
        axios.get('/API/route_grades').then(function(data) {
            var min_grade = 10000000;
            var max_grade = -1000000;
            var labels = {};

            for(var i=0;i<data.data.length;i++) {
                var v = data.data[i].grade_val;
                if (v > max_grade)
                    max_grade = v;
                if (v < min_grade)
                    min_grade = v;

                labels[1*v] = ""+data.data[i].grade;
                labels_rev[""+data.data[i].grade] = 1*v;
            }
            noUiSlider.create(slider, {
                start: [min_grade, max_grade], 
                step: 2,
                orientation: 'horizontal', 
                format: {
                    to: function (value) {
                        value = Math.round(value);
                        return (value in labels) ?  labels[value] : Math.round(value);
                    },
                    from: function (value) {
                        return (value in labels_rev) ? Math.round(labels_rev[value]) : value;
                    }
                },
                range: {
                            'min': min_grade,
                            'max': max_grade
                        },
                }).on('update', onUp);
            });
    }
    search_box_loaded = true;
    volet = document.getElementById('my-user-circle-partner');
    volet.style.transform = 'translateX(0)';
}
function toggleGyms() {
    var t = document.getElementById('show_gyms').checked;
    if (!t)
        map.removeLayer(gym_markers);
    else
        map.addLayer(gym_markers);
}

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
    gym_markers = L.markerClusterGroup();

    var searchMapButton = L.Control.extend({options: { position: 'topleft' }, onAdd: function (map) { 
        var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom-filter');
        container.style.backgroundColor = 'white';
        container.style.width = '35px';
        container.style.height = '35px';
        container.innerHTML = '<i class="tiny material-icons">tune</i>';
        container.onclick = function(){
            createSearchBox();
        };
        return container;
        },
    });
    map.addControl(new searchMapButton());

    //POSITIONNEMENT DU CONTROLER DE ZOOM
    L.control.zoom({position : 'bottomright'}).addTo(map);


    //CONTROLER DES TUILES
    L.control.layers(baseMaps).addTo(map);


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
