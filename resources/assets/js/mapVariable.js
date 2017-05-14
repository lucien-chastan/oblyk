//Marker simple
let marker_0000 = L.icon({iconUrl: '/img/marker-0000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_1111 = L.icon({iconUrl: '/img/marker-1111.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_1000 = L.icon({iconUrl: '/img/marker-1000.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0100 = L.icon({iconUrl: '/img/marker-0100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0010 = L.icon({iconUrl: '/img/marker-0010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0001 = L.icon({iconUrl: '/img/marker-0001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

//Marker double
let marker_1100 = L.icon({iconUrl: '/img/marker-1100.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0110 = L.icon({iconUrl: '/img/marker-0110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0011 = L.icon({iconUrl: '/img/marker-0011.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_1001 = L.icon({iconUrl: '/img/marker-1001.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0101 = L.icon({iconUrl: '/img/marker-0101.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_1010 = L.icon({iconUrl: '/img/marker-1010.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

//marker triple
let marker_1110 = L.icon({iconUrl: '/img/marker-1110.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_1101 = L.icon({iconUrl: '/img/marker-1101.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_1011 = L.icon({iconUrl: '/img/marker-1011.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});
let marker_0111 = L.icon({iconUrl: '/img/marker-0111.svg', iconSize: [24, 32], iconAnchor: [12, 32], popupAnchor: [0, -29]});

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
        <img class="photo-couve-site-leaflet" src="/storage/photos/crags/oblyk-home-baume-rousse.jpg" alt="photo de couverture de ${crag.label}">
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
    if(type === '0000') point = marker_0000;
    if(type === '0001') point = marker_0001;
    if(type === '0010') point = marker_0010;
    if(type === '0011') point = marker_0011;
    if(type === '0100') point = marker_0100;
    if(type === '0101') point = marker_0101;
    if(type === '0110') point = marker_0110;
    if(type === '0111') point = marker_0111;
    if(type === '1000') point = marker_1000;
    if(type === '1001') point = marker_1001;
    if(type === '1010') point = marker_1010;
    if(type === '1011') point = marker_1011;
    if(type === '1100') point = marker_1100;
    if(type === '1101') point = marker_1101;
    if(type === '1110') point = marker_1110;
    if(type === '1111') point = marker_1111;

    return point;
}