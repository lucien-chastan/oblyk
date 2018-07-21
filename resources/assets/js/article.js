let articleMap;

function initArticleMap(articleId) {

    articleMap = L.map('article-map',{ zoomControl : true, center:[46.5, 4.5], zoom : 5, layers: [carte]});

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(articleMap);

    let latLngPolyline = [];


    //ON VA CHERCHER LES SITES D'ESCALADES
    axios.get('/api/article/crags/' + articleId).then(function (response) {
        let crags = response.data;


        //ajoute les markeurs à la carte
        for(let i in crags){

            let markerIcon = styleIcon(crags[i].type_voie + '' + crags[i].type_grande_voie + '' + crags[i].type_bloc + '' + crags[i].type_deep_water + '' + crags[i].type_via_ferrata);

            L.marker(
                [crags[i].lat,crags[i].lng],
                {icon: markerIcon}
            ).bindPopup(buildPopup(crags[i])).addTo(articleMap);

            latLngPolyline.push([crags[i].lat, crags[i].lng])
        }

        let polyline = L.polyline(latLngPolyline, {color: 'rgba(255,255,255,0'}).addTo(articleMap);

        // zoom the map to the polyline
        articleMap.fitBounds(polyline.getBounds());

        // Zoom -1
        articleMap.setZoom(articleMap.getZoom() - 1);

        //on supprime la polyline de zoom
        polyline.remove();
    });
}

function buildArticleGraph() {
    var graphArea = document.getElementsByClassName('article-graph');
    for (var i = 0; i < graphArea.length; i++) {
        var cragId = graphArea[i].getAttribute('data-crag');
        buildeGraph(cragId, 'climb');
        buildeGraph(cragId, 'grade');
    }
}

function buildeGraph(cragId, type) {
    axios.get('/chart/crag/' + cragId + '/' + type).then(function (response) {
        new Chart(document.getElementById(type + "-" + cragId).getContext('2d'),response.data);
    });
}