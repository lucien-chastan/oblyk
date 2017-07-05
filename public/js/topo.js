let topoMap;

function initTopoMap() {
    let map = document.getElementById('topo-map');

    topoMap = L.map('topo-map',{ zoomControl : true, center:[45, 6], zoom : 16, layers: [carte]});

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(topoMap);
}