let cragMap;

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
        }

    });

}