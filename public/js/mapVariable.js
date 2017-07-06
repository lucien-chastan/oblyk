//Marker simple
let marker_00000 = L.icon({iconUrl: '/img/marker-00000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_11110 = L.icon({iconUrl: '/img/marker-11110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_10000 = L.icon({iconUrl: '/img/marker-10000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_01000 = L.icon({iconUrl: '/img/marker-01000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_00100 = L.icon({iconUrl: '/img/marker-00100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_00010 = L.icon({iconUrl: '/img/marker-00010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_00001 = L.icon({iconUrl: '/img/marker-00001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

//Marker double
let marker_11000 = L.icon({iconUrl: '/img/marker-11000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_01100 = L.icon({iconUrl: '/img/marker-01100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_00110 = L.icon({iconUrl: '/img/marker-00110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_10010 = L.icon({iconUrl: '/img/marker-10010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_01010 = L.icon({iconUrl: '/img/marker-01010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_10100 = L.icon({iconUrl: '/img/marker-10100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

//marker triple
let marker_11100 = L.icon({iconUrl: '/img/marker-11100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_11010 = L.icon({iconUrl: '/img/marker-11010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_10110 = L.icon({iconUrl: '/img/marker-10110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_01110 = L.icon({iconUrl: '/img/marker-01110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

//marker de parking
let marker_parking = L.icon({iconUrl: '/img/marker-parking.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_sale = L.icon({iconUrl: '/img/marker-sale.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});


//définition des différents style de tuile
let carte = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/outdoors-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
    satellite   = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v10/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1Ijoib2JseWsiLCJhIjoiY2oxMGl1MDJvMDAzbzJycGd1MWl6NDBpYyJ9.CXlzqHwoaZ0LlxWjuaj7ag', { attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});

//création du controlleur de tuile
let baseMaps = {
    "Relief": carte,
    "Satellite": satellite
};

//créer la popup html avec les données d'une falaise
function buildPopup(crag) {
    let html = `
        <img class="photo-couve-site-leaflet" src="${crag.bandeau}" alt="photo de couverture de ${crag.label}">
        <div class="crag-leaflet-info">
            <h2 class="loved-king-font titre-crag-leaflet">
                <a href="/site-escalade/${crag.id}/${string_to_slug(crag.label)}">${crag.label}</a>
            </h2>
            <table>
                <tr>
                    <td>Localisation : </td>
                    <td>${crag.city}, ${crag.region} (${crag.code_country})</td>
                </tr>
                <tr>
                    <td>Type de grimpe : </td>
                    <td class="type-grimpe">`;

    if(crag.type_voie === 1) html += '<span class="voie">voie</span>';
    if(crag.type_grande_voie === 1) html += '<span class="grande-voie">grande-voie</span>';
    if(crag.type_bloc === 1) html += '<span class="bloc">bloc</span>';
    if(crag.type_deep_water === 1) html += '<span class="deep-water">deep-water</span>';

    html +=
                    `</td>
                </tr>
                <tr>
                    <td>Lignes &amp; Cotations : </td>
                    <td>150 lignes, de 5a <i class="material-icons tiny">arrow_forward</i> 6a</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="btn-vers-crags">
                        <a href="/site-escalade/${crag.id}/${string_to_slug(crag.label)}" class="waves-effect waves-light btn">voir le site</a>
                    </td>
                </tr>
            </table>
         </div>
    `;

    return html;
}

//retourn l'objet icone qu'il faut utiliser
function styleIcon(type) {

    let point;
    if(type === '00000') point = marker_00000;
    if(type === '00001') point = marker_00001;
    if(type === '00010') point = marker_00010;
    if(type === '00100') point = marker_00100;
    if(type === '01000') point = marker_01000;
    if(type === '10000') point = marker_10000;
    if(type === '00110') point = marker_00110;
    if(type === '01010') point = marker_01010;
    if(type === '01100') point = marker_01100;
    if(type === '01110') point = marker_01110;
    if(type === '10010') point = marker_10010;
    if(type === '10100') point = marker_10100;
    if(type === '10110') point = marker_10110;
    if(type === '11000') point = marker_11000;
    if(type === '11010') point = marker_11010;
    if(type === '11100') point = marker_11100;
    if(type === '11110') point = marker_11110;

    return point;
}