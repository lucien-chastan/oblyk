let massiveMap;

function initMassiveMap(id_massive) {

    massiveMap = L.map('massive-map',{ zoomControl : true, center:[46.5, 4.5], zoom : 5, layers: [carte]});

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(massiveMap);

    let latLngPolyline = [];


    //ON VA CHERCHER LES SITES D'ESCALADES
    axios.get('/API/massive/crags/' + id_massive).then(function (response) {
        let crags = response.data;

        //ajoute les markeurs à la carte
        for(let i in crags){

            let markerIcon = styleIcon(crags[i].type_voie + '' + crags[i].type_grande_voie + '' + crags[i].type_bloc + '' + crags[i].type_deep_water + '' + crags[i].type_via_ferrata);

            L.marker(
                [crags[i].lat,crags[i].lng],
                {icon: markerIcon}
            ).bindPopup(buildPopup(crags[i])).addTo(massiveMap);

            latLngPolyline.push([crags[i].lat, crags[i].lng])

        }

        let polyline = L.polyline(latLngPolyline, {color: 'rgba(255,255,255,0'}).addTo(massiveMap);

        // zoom the map to the polyline
        massiveMap.fitBounds(polyline.getBounds());

        //on supprime la polyline de zoom
        polyline.remove();

    });
}