let map, markers;

//function au chargement de la map
function loadPartnerMap() {

    map = L.map('map',{ zoomControl : false, center:[46.927527, 2.871905], zoom : 5, layers: [carte]});
    markers = L.markerClusterGroup();

    L.control.zoom({position : 'bottomright'}).addTo(map);

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(map);

}