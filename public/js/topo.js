let topoMap;

function initTopoMap() {

    topoMap = L.map('topo-map',{ zoomControl : true, center:[46.5, 4.5], zoom : 5, layers: [carte]});

    //ajout du controleur de tuile
    L.control.layers(baseMaps).addTo(topoMap);

    let latLngPolyline = [];


    //ON VA CHERCHER LES SITES D'ESCALADES
    axios.get('/API/topo/crags/' + document.getElementById('id-topo-sites').value).then(function (response) {
        let crags = response.data;

        //ajoute les markeurs à la carte
        for(let i in crags){

            let markerIcon = styleIcon(crags[i].type_voie + '' + crags[i].type_grande_voie + '' + crags[i].type_bloc + '' + crags[i].type_deep_water + '' + crags[i].type_via_ferrata);

            L.marker(
                [crags[i].lat,crags[i].lng],
                {icon: markerIcon}
            ).bindPopup(buildPopup(crags[i])).addTo(topoMap);

            latLngPolyline.push([crags[i].lat, crags[i].lng])

        }


        //ON VA CHERCHER LES POINTS DE VENTE
        axios.get('/API/topo/sales/' + document.getElementById('id-topo-sites').value).then(function (response) {
            let sales = response.data;

            //ajoute les markeurs à la carte
            for(let i in sales){

                if(sales[i].lat !== 0 && sales[i].lng !== 0){
                    L.marker(
                        [sales[i].lat,sales[i].lng],
                        {icon: marker_sale}
                    ).bindPopup('<div class="popup-map-sale-topo"><p class="text-center loved-king-font titre-sale-popup">' + sales[i].label + '</p><p>' + sales[i].description + '<br><a target="_blank" href="' + sales[i].url + '">' + sales[i].url + '</a></p></div>').addTo(topoMap);

                    latLngPolyline.push([sales[i].lat, sales[i].lng])
                }
            }

            let polyline = L.polyline(latLngPolyline, {color: 'rgba(255,255,255,0'}).addTo(topoMap);

            // zoom the map to the polyline
            topoMap.fitBounds(polyline.getBounds());

            //on supprime la polyline de zoom
            polyline.remove();
        });
    });
}

function uploadCouverture(form, callback) {
    let inputData = form.getElementsByClassName('input-data'),
        data = new FormData();

    showSubmitLoader(true);

    data.append('foo', 'bar');
    data.append('file', document.getElementById('upload-input-couverture-topo').files[0]);

    //ajout les autres données à passage de la form
    for(let i in inputData){
        if(typeof inputData[i].value !== "undefined") data.append([inputData[i].name], inputData[i].value);
    }

    let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            document.getElementById('progressbar-upload-couverture').style.width = percentCompleted + '%';
        }
    };

    axios.post('/upload/topoCouverture', data, config).then(
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

function getTopoPosts() {
    getPosts('Topo',document.getElementById('id-topo-actualite').value, document.getElementById('insert-posts-zone'));
}